<?php

namespace App\Http\Livewire;

use App\Enums\UserRolesEnum;
use App\Models\Appointment;
use Carbon\Carbon;
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

    public $confirmAppointmentCancellation  = false;
    public $confirmingAppointmentCancellation = false;

    private $timeNow;

    public $selectFilter = 'upcoming'; // can be 'upcoming' , 'previous' , 'cancelled'

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
        'appointment.status' => 'required|boolean',
    ];

    public function mount($userId = null, $selectFilter = 'upcoming') {

       if (auth()->user()->role->name == "Customer") {
            $this->userId = auth()->user()->id;
        } else if (auth()->user()->role->name == ("Cashier" || "Owner")) {
           $this->userId = $userId;
        }
        $selectFilter ? $this->selectFilter = $selectFilter : $this->selectFilter = 'upcoming';

        $this->timeNow = Carbon::now();
    }

    public function render()
    {
        $query = Appointment::with('timeSlot', 'user', 'service', 'location');
        if ($this->search) {
            $query->where(function ($subQuery) {
                $subQuery
                    ->where('date', 'like', '%' . $this->search . '%')
                    ->orWhere('appointment_code', 'like', '%' . $this->search . '%')
                    ->orWhere('start_time', 'like', '%' . $this->search . '%')
                    ->orWhere('end_time', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('service_id', 'like', '%' . $this->search . '%')
                    ->orWhere('time_slot_id', 'like', '%' . $this->search . '%')
                    ->orWhere('location_id', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('user', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('service', function ($serviceQuery) {
                $serviceQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('category_id', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('location', function ($locationQuery) {
                $locationQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%')
                    ->orWhere('telephone_number', 'like', '%' . $this->search . '%');
            });
        }


        if ($this->userId) {

            $query->where('user_id', $this->userId);
        }
//        dd($this->selectFilter);
        if ($this->selectFilter === 'previous') {
            $query->whereDate('date', '<', Carbon::today())->where('status', 1);

        } else if ($this->selectFilter === 'upcoming') {
            $query->whereDate('date', '>=', Carbon::today())->where('status', 1);

        } else if ($this->selectFilter === 'cancelled') {
            $query->where('status', 0);
        }


        $this->appointments = $query
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
//        dd($this->appointments);

        return view('livewire.manage-appointments', [
            'appointments' => $this->appointments,
        ]);
    }




    public function confirmAppointmentEdit(Appointment $appointment) {
        $this->appointment = $appointment;
        $this->confirmingAppointmentAdd= true;
    }
    public function confirmAppointmentCancellation() {
        $this->confirmingAppointmentCancellation = true;
    }

    public function saveAppointment()
    {
        $this->validate();

        if (isset($this->appointment->id)) {
            $this->appointment->save();
            session()->flash('message', 'Appointment successfully updated.');
        } else {
            $queueNumber = Appointment::where('date', $this->appointment['date'])->count() + 1;
            Appointment::create([
                'cart_id' => $this->appointment['cart_id'],
                'user_id' => $this->appointment['user_id'],
                'service_id' => $this->appointment['service_id'],
                'date' => $this->appointment['date'],
                'time_slot_id' => $this->appointment['time_slot_id'],
                'start_time' => $this->appointment['start_time'],
                'end_time' => $this->appointment['end_time'],
                'location_id' => $this->appointment['location_id'],
                'total' => $this->appointment['total'],
                'status' => $this->appointment['status'],
                'queue_number' => $queueNumber,
            ]);
            session()->flash('message', 'Appointment successfully created.');
        }

        $this->confirmingAppointmentAdd = false;
        $this->appointment = null;
    }

    public function cancelAppointment(Appointment $appointment)
    {
        $this->appointment = $appointment;


        if (auth()->user()->id == $this->appointment->user->id
            || auth()->user()->role->name == (UserRolesEnum::Cashier->name || UserRolesEnum::Owner->name)) {

            $this->appointment->status = 0;
//        $this->appointment->cancelled_by = auth()->user()->id;
            // TODO add reason
            $this->appointment->save();
            $this->confirmingAppointmentCancellation = false;
        }
    }

    public function confirmAppointmentAdd() {
        $this->confirmingAppointmentAdd = true;
    }

}
