<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    // use WithPagination;

    public string $email = '';
    public ?string $status = null; // success | exists | null

    public function subscribe(): void
    {
        $this->status = null;

        $this->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        if (Subscriber::where('email', $this->email)->exists()) {
            $this->status = 'exists';
            $this->reset('email');
            return;
        }

        Subscriber::create([
            'email' => $this->email,
        ]);

        $this->status = 'success';
        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.pages.home', [
            'posts' => Post::query()
                ->published()
                ->with(['category', 'author', 'tags'])
                ->latest('published_at')
                ->limit(7)
                ->get()
        ]);
    }
}
