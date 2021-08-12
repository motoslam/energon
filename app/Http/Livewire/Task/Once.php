<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class Once extends Component
{
    public $task;

    public $expired;

    public $expired_at = '';

    public function mount($task)
    {
        $this->task = $task;

        $this->expired = $task->expired;

        if ($this->expired) {
            $this->expired_at = now()->diffInDays($task->deadline_at);
        }
    }

    public function render()
    {
        return view('livewire.task.once');
    }
}
