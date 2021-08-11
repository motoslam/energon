<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Attach extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function render()
    {
        $view = '';
        if ($this->event->attachable_type == "App\Models\Contact") {
            $view = 'livewire.attach.contact';
        }
        return view($view);
    }
}
