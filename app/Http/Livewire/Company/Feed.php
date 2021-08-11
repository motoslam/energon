<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Feed extends Component
{
    public $company;

    public function mount($company)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.company.feed');
    }
}
