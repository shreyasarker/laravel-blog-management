<?php

namespace App\Livewire\Pages;

use App\Models\Contact as ContactModel;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public ?string $status = null;

    public function submit(): void
    {
        $this->status = null;

        // Validate form
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Save to database
        ContactModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        // Optional: Send email notification
        // Mail::to('your@email.com')->send(new ContactFormSubmitted($this->all()));

        // Reset form
        $this->reset(['name', 'email', 'subject', 'message']);

        // Set success status
        $this->status = 'success';
    }

    public function render()
    {
        return view('livewire.pages.contact');
    }
}
