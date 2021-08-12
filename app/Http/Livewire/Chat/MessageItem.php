<?php

namespace App\Http\Livewire\Chat;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessageItem extends Component
{
    public $message;
    public $isOwn = false;

    protected $listeners = ['loadNewMessage' => '$refresh'];

    public function mount($message)
    {
        $this->message = $message;
        $this->isOwn = ($this->message->user->id == Auth::user()->id);
    }

    public function render()
    {
        return view('livewire.chat.message-item');
    }
}
