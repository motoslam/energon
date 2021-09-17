<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Attach extends Component
{
    public $event;
    public $template;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function render()
    {
        $view = '';
        if ($this->event->attachable_type == "App\Models\Order") {
            $view = 'livewire.attach.order';
        }
        if ($this->event->attachable_type == "App\Models\Contact") {
            $view = 'livewire.attach.contact';
        }
        if ($this->event->attachable_type == "App\Models\Comment") {
            $view = 'livewire.attach.comment';
        }
        if ($this->event->attachable_type == "App\Models\Offer") {
            $view = 'livewire.attach.offer';
        }
        if ($this->event->attachable_type == "App\Models\Call") {
            $view = 'livewire.attach.call';
        }
        return $view ? view($view) : '<div></div>';
    }
}
