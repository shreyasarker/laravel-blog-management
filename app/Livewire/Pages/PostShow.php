<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use Livewire\Component;

class PostShow extends Component
{
    public Post $post;
    public $relatedPosts;

    public function mount(string $slug)
    {
        // Load the post with relationships
        $this->post = Post::query()
            ->published()
            ->with(['category', 'tags', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Load related posts from same category
        $this->relatedPosts = Post::query()
            ->published()
            ->with(['category', 'author', 'tags'])
            ->where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->latest('published_at')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.post-show')->title($this->post->title . ' - My Blog');
    }
}
