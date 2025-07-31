<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class ManageCategories extends Component
{
    private $categories;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $category;

    public $confirmingCategoryAdd;

    public $confirmingCategoryDeletion = false;

    public $categoryIdToDelete;

    protected $rules = [
        'category.name' => 'required|string|max:255',
    ];

    public function render()
    {
        $this->categories = Category::when($this->search, function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })->orderBy('id', 'asc')->paginate(10);

        return view('livewire.manage-categories', [
            'categories' => $this->categories,
        ]);
    }

    public function confirmCategoryEdit(Category $category)
    {
        $this->category = $category;
        $this->confirmingCategoryAdd = true;
    }

    public function confirmCategoryDeletion($categoryId)
    {
        $this->categoryIdToDelete = $categoryId;
        $this->confirmingCategoryDeletion = true;
    }

    public function saveCategory()
    {
        $this->validate();

        if (isset($this->category->id)) {
            $this->category->save();
        } else {
            Category::create(
                [
                    'name' => $this->category['name'],
                ]
            );
        }

        $this->confirmingCategoryAdd = false;
        $this->category = null;
        session()->flash('message', 'Category saved successfully.');
    }

    public function deleteCategory()
    {
        Category::find($this->categoryIdToDelete)->delete();
        $this->confirmingCategoryDeletion = false;
        session()->flash('message', 'Category deleted successfully.');
    }

    public function confirmCategoryAdd()
    {
        $this->confirmingCategoryAdd = true;
    }
}
