<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class Success extends Component
{
    public $success = '';

    protected $listeners = ['showSuccess', 'hideSuccess'];

    public function showSuccess($message)
    {
        $this->success = $message;
    }

    public function hideSuccess()
    {
        $this->success = '';
    }

    public function render()
    {
        return view('livewire.task.success');
    }
}
