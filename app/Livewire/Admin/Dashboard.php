<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Subscriber;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalPosts' => Post::count(),
            'publishedPosts' => Post::where('status', 'published')->count(),
            'totalCategories' => Category::count(),
            'totalSubscribers' => Subscriber::count(),
            'totalContacts' => Contact::count(),
            'recentPosts' => Post::with('category')->latest()->limit(5)->get(),
            'recentContacts' => Contact::latest()->limit(5)->get(),
        ]);
    }
}
