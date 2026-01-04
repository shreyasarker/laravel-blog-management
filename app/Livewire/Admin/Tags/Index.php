<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
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
        'slug' => 'required|string|max:255|unique:tags,slug',
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
        $tag = Tag::findOrFail($id);
        $this->editingId = $id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editingId) {
            $this->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:tags,slug,' . $this->editingId,
            ]);

            $tag = Tag::findOrFail($this->editingId);
            $tag->update([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);

            session()->flash('message', 'Tag updated successfully!');
        } else {
            $this->validate();

            Tag::create([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);

            session()->flash('message', 'Tag created successfully!');
        }

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);

        if ($tag->posts()->count() > 0) {
            session()->flash('error', 'Cannot delete tag with posts!');
            return;
        }

        $tag->delete();
        session()->flash('message', 'Tag deleted successfully!');
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
        $query = Tag::withCount('posts');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.tags.index', [
            'tags' => $query->latest()->paginate(15),
        ]);
    }
}
