<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $selectedMessage = null;
    public $showModal = false;

    public function viewMessage($id)
    {
        $this->selectedMessage = Contact::findOrFail($id);

        // Mark as read if not already
        if (!$this->selectedMessage->is_read) {
            $this->selectedMessage->update(['is_read' => true]);
        }

        $this->showModal = true;
    }

    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        session()->flash('message', 'Message marked as read!');
    }

    public function markAsUnread($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => false]);

        session()->flash('message', 'Message marked as unread!');
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        session()->flash('message', 'Message deleted successfully!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedMessage = null;
    }

    public function render()
    {
        $query = Contact::query();

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('subject', 'like', '%' . $this->search . '%')
                    ->orWhere('message', 'like', '%' . $this->search . '%');
            });
        }

        // Filter by status
        if ($this->filterStatus !== '') {
            $query->where('is_read', $this->filterStatus);
        }

        return view('livewire.admin.contacts.index', [
            'contacts' => $query->latest()->paginate(15),
            'unreadCount' => Contact::where('is_read', false)->count(),
        ]);
    }
}
