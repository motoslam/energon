<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class MessagesList extends Component
{
    public $task_id;
    public $messages;

    protected $listeners = ['loadNewMessage'];

    public function mount($task)
    {
        $this->task_id = $task->id;
        $this->loadNewMessage();
    }

    public function loadNewMessage()
    {
        $this->messages = Message::where('task_id', '=', $this->task_id)
            ->latest()->get();
    }

    public function callUpdate()
    {
        $this->emit('loadNewMessage');
    }

    public function render()
    {
        return view('livewire.chat.messages-list');
    }
}
