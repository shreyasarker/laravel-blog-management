<?php

namespace App\Livewire;

use Livewire\Component;

class TestLivewire extends Component
{
    public $message = 'Not working';

    public function changeMessage()
    {
        $this->message = 'IT WORKS!';
    }

    public function render()
    {
        return view('livewire.test-livewire');
    }
}
