<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Create extends Component
{
    public $title = '';
    public $slug = '';
    public $category_id = '';
    public $excerpt = '';
    public $body = '';
    public $status = 'draft';
    public $published_at = '';
    public $selectedTags = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:posts,slug',
        'category_id' => 'required|exists:categories,id',
        'excerpt' => 'nullable|string|max:500',
        'body' => 'required|string',
        'status' => 'required|in:draft,published',
        'published_at' => 'nullable|date',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        // If status is published and no publish date, set it to now
        if ($this->status === 'published' && !$this->published_at) {
            $this->published_at = now();
        }

        // Create post
        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'status' => $this->status,
            'published_at' => $this->published_at,
        ]);

        // Attach tags if selected
        if (!empty($this->selectedTags)) {
            $post->tags()->attach($this->selectedTags);
        }

        session()->flash('message', 'Post created successfully!');

        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.posts.create', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
}