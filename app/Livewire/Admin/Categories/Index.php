<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $slug = '';
    public $editingId = null;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug',
    ];

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->editingId = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editingId) {
            $this->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:categories,slug,' . $this->editingId,
            ]);

            $category = Category::findOrFail($this->editingId);
            $category->update([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);

            session()->flash('message', 'Category updated successfully!');
        } else {
            $this->validate();

            Category::create([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);

            session()->flash('message', 'Category created successfully!');
        }

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->posts()->count() > 0) {
            session()->flash('error', 'Cannot delete category with posts!');
            return;
        }

        $category->delete();
        session()->flash('message', 'Category deleted successfully!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->slug = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Category::withCount('posts');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.categories.index', [
            'categories' => $query->latest()->paginate(15),
        ]);
    }
}