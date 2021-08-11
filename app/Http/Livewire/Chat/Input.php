<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Input extends Component
{
    public $task;

    public function mount($task) {
        $this->task = $task;
    }

    public function submit(){

    }

    public function render()
    {
        return view('livewire.chat.input');
    }
}
