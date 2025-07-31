<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTransactionHistory extends Component
{
    use WithPagination;

    private $appointments;

    public function render()
    {
        $this->appointments = Appointment::where('user_id', auth()->user()->id)
            
            ->with('service', 'location', 'timeSlot')
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('livewire.customer-transaction-history', [
            'appointments' => $this->appointments,
        ]);
    }
}
