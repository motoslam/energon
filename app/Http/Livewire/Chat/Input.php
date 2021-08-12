<?php

namespace App\Http\Livewire\Chat;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Message;

class Input extends Component
{
    public $task;
    public $body;

    public function mount($task)
    {
        $this->task = $task;
    }

    public function submit()
    {
        $this->body = trim($this->body);
        if (!empty($this->body)) {

            Message::create([
                'task_id' => $this->task->id,
                'user_id' => Auth::user()->id,
                'body' => $this->body,
            ]);

            $this->reset('body');

            $this->emit('loadNewMessage');
        }
    }

    public function render()
    {
        return view('livewire.chat.input');
    }
}
