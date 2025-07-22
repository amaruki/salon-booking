<?php

namespace App\Http\Controllers;

use App\Jobs\SendAppointmentConfirmationMailJob;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Collection\Collection;
use Illuminate\Support\Collection as LaravelCollection;

class CartController extends Controller
{
    public function index()
    {
        // get the cart of the user that is not paid
        $cart = auth()->user()->cart()
            ->where('is_paid', false)

            ->first();

        return view('web.cart', compact('cart'));

    }

    public function checkout(Request $request)
    {
        Log::info('Checkout function started.');
        // Get the cart of the user that is not paid
        $cart = auth()->user()->cart()->where('is_paid', false)->first();

        // If the cart is not found, redirect back
        if (! $cart) {
            Log::info('Cart not found or already paid.');
            return redirect()->back();
        }

        $selectedServiceIds = $request->input('selected_services', []);
        Log::info('Selected service IDs: ' . json_encode($selectedServiceIds));

        if (empty($selectedServiceIds)) {
            Log::info('No services selected for checkout.');
            return redirect()->back()->with('error', __('No services selected for checkout.'));
        }

        $is_time_slots_available = true;
        $unavailable_time_slots = new Collection('array');

        // Filter services based on selectedServiceIds
        $selectedServices = $cart->services->filter(function ($service) use ($selectedServiceIds) {
            return in_array($service->pivot->id, $selectedServiceIds);
        });
        Log::info('Filtered selected services count: ' . $selectedServices->count());

        // Check if the time slot is available for selected services
        $selectedServices->map(function ($service) use ($unavailable_time_slots, &$is_time_slots_available) {
            $is_available = DB::table('appointments')
                ->where('date', $service->pivot->date)
                ->where('time_slot_id', $service->pivot->time_slot_id)
                ->where('location_id', $service->pivot->location_id)
                ->doesntExist();

            if (! $is_available) {
                $is_time_slots_available = false;
                $start_time = DB::table('time_slots')->where('id', $service->pivot->time_slot_id)->value('start_time');
                $end_time = DB::table('time_slots')->where('id', $service->pivot->time_slot_id)->value('end_time');
                $service_name = $service->name;

                $unavailable_time_slots->add(
                    [
                        'service_name' => $service_name,
                        'date' => $service->pivot->date,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'location' => $service->pivot->location->name,
                    ]
                );
                Log::warning('Time slot unavailable for service: ' . $service_name . ' on ' . $service->pivot->date);
            }
        });

        if (! $is_time_slots_available) {
            Log::warning('Redirecting back due to unavailable time slots.');
            return redirect()->back()->with('unavailable_time_slots', $unavailable_time_slots);
        }

        DB::transaction(function () use ($cart, $selectedServices, $selectedServiceIds) {
            Log::info('Starting database transaction.');
            $unique_date_locations = new Collection('array');
            $createdAppointments = new Collection(\App\Models\Appointment::class);

            foreach ($selectedServices as $service) {
                $timeSlot = DB::table('time_slots')->where('id', $service->pivot->time_slot_id)->first();
                Log::info('Creating appointment for service ID: ' . $service->id . ' at ' . $service->pivot->date . ' ' . $timeSlot->start_time);

                $appointment = Appointment::create([
                    'cart_id' => $cart->id,
                    'user_id' => $cart->user_id,
                    'service_id' => $service->id,
                    'time_slot_id' => $service->pivot->time_slot_id,
                    'date' => $service->pivot->date,
                    'start_time' => $timeSlot->start_time,
                    'end_time' => $timeSlot->end_time,
                    'location_id' => $service->pivot->location_id,
                    'total' => $service->pivot->price,
                    'status' => false, // Set status to false (unpaid) by default
                ]);
                $createdAppointments->add($appointment);

                // Delete the service from the cart_service pivot table
                DB::table('cart_service')->where('id', $service->pivot->id)->delete();
                Log::info('Deleted cart_service pivot entry for ID: ' . $service->pivot->id);

                // Collect unique date and location pairs for queue number recalculation
                $unique_date_locations->add([
                    'date' => $service->pivot->date,
                    'location_id' => $service->pivot->location_id,
                ]);
            }

            // Recalculate cart total after removing items
            $cart->total = $cart->services()->sum('cart_service.price');
            Log::info('Cart new total: ' . $cart->total);

            // Mark cart as paid only if it becomes empty
            if ($cart->services()->count() == 0) {
                $cart->is_paid = true;
                Log::info('Cart is now empty, marking as paid.');
            }
            $cart->save();
            Log::info('Cart saved.');

            // Recalculate queue numbers once for each unique date and location
            foreach ((new LaravelCollection($unique_date_locations->toArray()))->unique(function ($item) {
                return $item['date'] . '-' . $item['location_id'];
            }) as $data) {
                Appointment::recalculateQueueNumbers($data['date'], $data['location_id']);
                Log::info('Recalculated queue numbers for date: ' . $data['date'] . ' and location: ' . $data['location_id']);
            }

            $customer = auth()->user();
            foreach ($createdAppointments as $appointment) {
                SendAppointmentConfirmationMailJob::dispatch($customer, $appointment);
                Log::info('Dispatched confirmation email for appointment ID: ' . $appointment->id);
            }
            Log::info('Database transaction committed.');
        });

        Log::info('Checkout function finished successfully.');
        return redirect()->route('dashboard')->with('success', __('Your appointment(s) have been booked successfully'));

    }

    public function removeItem($cart_service_id)
    {
        // Get the cart of the user that is not paid
        $cart = auth()->user()->cart()->where('is_paid', false)->first();

        if (! $cart) {
            return redirect()->back();
        }

        // Find the specific service in the cart's pivot table
        $cartService = DB::table('cart_service')
            ->where('id', $cart_service_id)
            ->where('cart_id', $cart->id)
            ->first();

        if (! $cartService) {
            // Item not found in cart, maybe already removed
            return redirect()->back()->with('error', __('Item not found in your cart.'));
        }

        // Detach the service from the cart using the pivot table record ID
        // Note: Eloquent's detach works with service_id, not the pivot id.
        // So, a direct delete on the pivot table is still the most straightforward here.
        DB::table('cart_service')->where('id', $cart_service_id)->delete();

        // Update the total price of the cart
        $newTotal = $cart->services()->sum('cart_service.price');
        $cart->total = $newTotal;
        $cart->save();

        return redirect()->back()->with('success', __('Item removed from cart.'));
    }

    public function destroy($id)
    {
        // Get the cart of the user that is not paid
        $cart = auth()->user()->cart()->where('is_paid', false)->first();

        if (! $cart) {
            return redirect()->back();
        }

        // Find the specific service in the cart's pivot table
        $cartService = DB::table('cart_service')
            ->where('id', $id)
            ->where('cart_id', $cart->id)
            ->first();

        if (! $cartService) {
            // Item not found in cart, maybe already removed
            return redirect()->back()->with('error', __('Item not found in your cart.'));
        }

        // Detach the service from the cart using the pivot table record ID
        // Note: Eloquent's detach works with service_id, not the pivot id.
        // So, a direct delete on the pivot table is still the most straightforward here.
        DB::table('cart_service')->where('id', $id)->delete();

        // Update the total price of the cart
        $newTotal = $cart->services()->sum('cart_service.price');
        $cart->total = $newTotal;
        $cart->save();

        return redirect()->back()->with('success', __('Item removed from cart.'));
    }
}
