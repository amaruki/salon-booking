<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\UploadedFile;

class ManageServices extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $confirmingServiceDeletion = false;
    public $confirmingServiceAdd = false;
    public $confirmingServiceEdit = false;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $newService = [
        'name' => '',
        'slug' => '',
        'description' => '',
        'price' => '',
        'is_hidden' => false,
        'category_id' => '',
    ];

    public $image; // Untuk file upload baru (UploadedFile)
    public $existingImagePath; // Untuk path gambar lama

    protected function rules()
    {
        $rules = [
            'newService.name' => 'required|string|max:255',
            'newService.slug' => 'nullable|unique:services,slug,' . ($this->newService['id'] ?? 'NULL'),
            'newService.description' => 'required|string|max:255',
            'newService.price' => 'required|numeric|min:0',
            'newService.is_hidden' => 'boolean',
            'newService.category_id' => 'required|integer|exists:categories,id',
        ];

        if ($this->image instanceof UploadedFile) {
            $rules['image'] = 'image|mimes:jpg,jpeg,png,svg,gif,webp|max:2048';
        }

        return $rules;
    }

    public function render()
    {
        $services = Service::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('id', 'asc')
            ->orderByPrice('PriceLowToHigh')
            ->with('category')
            ->paginate(10);

        $categories = Category::all();

        return view('livewire.manage-services', compact('services', 'categories'));
    }

    public function confirmServiceDeletion($id)
    {
        $this->confirmingServiceDeletion = $id;
    }

    public function deleteService(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        session()->flash('message', __('Service successfully deleted.'));
        $this->confirmingServiceDeletion = false;
    }

    public function confirmServiceAdd()
    {
        $this->reset(['newService', 'image', 'existingImagePath']);
        $this->confirmingServiceAdd = true;
    }

    public function confirmServiceEdit(Service $service)
    {
        $this->newService = $service->toArray();
        $this->existingImagePath = $service->image;
        $this->image = null;
        $this->confirmingServiceAdd = true;
    }

    public function saveService()
    {
        $this->validate();

        $imagePath = $this->existingImagePath;

        if ($this->image instanceof UploadedFile) {
            if ($this->existingImagePath) {
                Storage::disk('public')->delete($this->existingImagePath);
            }

            $imagePath = $this->image->store('images', 'public');
        }

        $data = $this->newService;
        $data['image'] = $imagePath;

        // Update
        if (isset($data['id'])) {
            $service = Service::findOrFail($data['id']);

            if ($service->name !== $data['name']) {
                $data['slug'] = Str::slug($data['name']);
                $this->validate(['newService.slug' => 'unique:services,slug,' . $data['id']]);
            }

            $service->update($data);
        } else {
            // Create
            $data['slug'] = Str::slug($data['name']);
            Service::create($data);
        }

        session()->flash('message', __('Service successfully saved.'));

        $this->reset(['newService', 'image', 'existingImagePath', 'confirmingServiceAdd']);
    }
}
