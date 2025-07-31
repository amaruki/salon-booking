<?php

namespace App\Http\Livewire;

use App\Enums\UserRolesEnum;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\Location;
use App\Models\Service;
use App\Models\TimeSlot;
use Livewire\Component;

class ManageAppointments extends Component
{
    private $appointments;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $appointment;

    public $confirmingAppointmentAdd;

    public $confirmingAppointmentEdit = false;

    public $confirmAppointmentCancellation = false;

    public $confirmingAppointmentCancellation = false;

    private $timeNow;

    public $selectFilter = 'unpaid'; // Default filter

    private $userId;

    protected $rules = [
        'appointment.cart_id' => 'required|integer|exists:carts,id',
        'appointment.user_id' => 'required|integer|exists:users,id',
        'appointment.service_id' => 'required|integer|exists:services,id',
        'appointment.date' => 'required|date',
        'appointment.time_slot_id' => 'required|integer|exists:time_slots,id',
        'appointment.start_time' => 'required|string',
        'appointment.end_time' => 'required|string',
        'appointment.location_id' => 'required|integer|exists:locations,id',
        'appointment.total' => 'required|numeric',
        'appointment.status' => 'required|integer',
    ];

    public function mount($userId = null, $selectFilter = 'unpaid')
    {
        $user = auth()->user();
        if ($user->role->name == 'Customer') {
            $this->userId = $user->id;
        } else { // Cashier or Owner
            $this->userId = $userId;
        }

        $this->selectFilter = $selectFilter ?: 'unpaid';
        $this->timeNow = Carbon::now();
    }

    public function render()
    {
        $query = Appointment::with('timeSlot', 'user', 'service', 'location');

        if ($this->search) {
            $query->where(function ($subQuery) {
                $subQuery
                    ->where('date', 'like', '%'.$this->search.'%')
                    ->orWhere('appointment_code', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        switch ($this->selectFilter) {
            case 'unpaid':
                $query->where('status', 0);
                break;
            case 'upcoming':
                $query->where('status', 1)->whereDate('date', '>=', Carbon::today());
                break;
            case 'previous':
                $query->where('status', 1)->whereDate('date', '<', Carbon::today());
                break;
            case 'cancelled':
                $query->where('status', 2);
                break;
        }

        $this->appointments = $query
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('livewire.manage-appointments', [
            'appointments' => $this->appointments,
            'timeSlots' => TimeSlot::all(),
            'services' => Service::all(),
            'locations' => Location::all(),
        ]);
    }

    public function markAsPaid($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 1; // 1 for Paid
        $appointment->save();

        session()->flash('message', 'Appointment marked as paid.');
    }

    public function completeAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 3; // Assuming 3 for Completed, adjust as per your status definitions
        $appointment->save();

        session()->flash('message', 'Appointment marked as completed.');
    }

    public function confirmAppointmentCancellation($appointmentId)
    {
        $this->appointment = Appointment::findOrFail($appointmentId);
        $this->confirmingAppointmentCancellation = true;
    }

    public function confirmAppointmentEdit($appointmentId)
    {
        $this->reset('appointment'); // Reset the appointment property
        $this->appointment = Appointment::findOrFail($appointmentId);
        $this->confirmingAppointmentEdit = true;
    }

    public function cancelAppointment()
    {
        $user = auth()->user();
        if ($user->id == $this->appointment->user_id || in_array($user->role->name, [UserRolesEnum::Cashier->name, UserRolesEnum::Owner->name])) {
            $cancelledAppointment = $this->appointment;
            $date = $cancelledAppointment->date;
            $location_id = $cancelledAppointment->location_id;

            $cancelledAppointment->status = 2; // 2 for Cancelled
            $cancelledAppointment->queue_number = null;
            $cancelledAppointment->save();

            Appointment::recalculateQueueNumbers($date, $location_id);

            $this->confirmingAppointmentCancellation = false;
            session()->flash('message', 'Appointment has been cancelled.');
        }
    }

    public function updateAppointment()
    {
        $this->validate([
            'appointment.date' => 'required|date',
            'appointment.time_slot_id' => 'required|integer|exists:time_slots,id',
            'appointment.service_id' => 'required|integer|exists:services,id',
            'appointment.location_id' => 'required|integer|exists:locations,id',
        ]);
        $this->appointment->save();

        $this->confirmingAppointmentEdit = false;
        session()->flash('message', 'Appointment updated successfully.');
    }
}

