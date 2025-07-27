<?php

namespace App\Http\Livewire;

use App\Models\Deal;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageDeals extends Component
{
    use withPagination, WithFileUploads;

    public $confirmingDealDeletion = false;
    public $confirmingDealAdd = false;
    public $confirmingDealEdit = false;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $newDeal;
    public $services;
    public $image;

    protected function rules()
    {
        return [
            'newDeal.name' => 'required|string|min:1|max:255',
            'newDeal.description' => 'required|string|min:1|max:255',
            'newDeal.discount' => 'required|numeric|min:0|max:100',
            'newDeal.start_date' => 'required|date',
            'newDeal.end_date' => 'required|date|after_or_equal:newDeal.start_date',
            'newDeal.is_hidden' => 'boolean',
            'newDeal.service_id' => 'required|exists:services,id',
            'newDeal.price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:1024',
        ];
    }

    public function mount()
    {
        $this->services = Service::all();
    }

    public function render()
    {
        $deals = Deal::with('service')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('start_date', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.manage-deals', [
            'deals' => $deals,
        ]);
    }

    public function confirmDealDeletion($id)
    {
        $this->confirmingDealDeletion = $id;
    }

    public function deleteDeal(Deal $deal)
    {
        $deal->delete();
        session()->flash('message', __('Deal successfully deleted.'));
        $this->confirmingDealDeletion = false;
    }

    public function confirmDealAdd()
    {
        $this->reset(['newDeal']);
        $this->confirmingDealAdd = true;
    }

    public function confirmDealEdit(Deal $newDeal)
    {
        $this->newDeal = $newDeal;
        $this->confirmingDealAdd = true;
    }

    public function saveDeal()
    {
        $this->validate();

        if ($this->image) {
            $this->newDeal['image'] = $this->image->store('deals', 'public');
        }

        // Ensure price is null if empty string
        if (empty($this->newDeal['price'])) {
            $this->newDeal['price'] = null;
        }

        if (isset($this->newDeal->id)) {
            $this->newDeal->save();
        } else {
            Deal::create([
                'name' => $this->newDeal['name'],
                'description' => $this->newDeal['description'],
                'discount' => $this->newDeal['discount'],
                'start_date' => $this->newDeal['start_date'],
                'end_date' => $this->newDeal['end_date'],
                'is_hidden' => $this->newDeal['is_hidden'] ?? false,
                'service_id' => $this->newDeal['service_id'],
                'price' => $this->newDeal['price'],
                'image' => $this->newDeal['image'] ?? null,
            ]);
        }

        session()->flash('message', __('Deal successfully saved.'));
        $this->confirmingDealAdd = false;
    }
}