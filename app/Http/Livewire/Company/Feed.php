<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use App\Models\Event;
use Livewire\Component;

class Feed extends Component
{
    public $company;

    public $events;

    protected $listeners = ['eventAdded'];

    public function mount($company)
    {
        $this->company = $company;
        $this->events = $company->events;
    }

    public function eventAdded()
    {
        $this->events = $this->company->events->fresh('attachable');
    }

    public function render()
    {
        return view('livewire.company.feed');
    }
}
