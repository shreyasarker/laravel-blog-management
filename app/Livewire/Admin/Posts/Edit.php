<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Edit extends Component
{
    public Post $post;
    public $title = '';
    public $slug = '';
    public $category_id = '';
    public $excerpt = '';
    public $body = '';
    public $status = 'draft';
    public $published_at = '';
    public $selectedTags = [];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->category_id = $post->category_id;
        $this->excerpt = $post->excerpt;
        $this->body = $post->body;
        $this->status = $post->status;
        $this->published_at = $post->published_at?->format('Y-m-d\TH:i');
        $this->selectedTags = $post->tags->pluck('id')->toArray();
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $this->post->id,
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ];
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate();

        // If status is published and no publish date, set it to now
        if ($this->status === 'published' && !$this->published_at) {
            $this->published_at = now();
        }

        // Update post
        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'status' => $this->status,
            'published_at' => $this->published_at,
        ]);

        // Sync tags
        $this->post->tags()->sync($this->selectedTags);

        session()->flash('message', 'Post updated successfully!');

        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.posts.edit', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
}
