<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Contacts extends Component
{
    public $company;

    public $contacts;

    public function mount($company)
    {
        $this->company = $company;

        $this->contacts = $company->contacts;
    }

    public function render()
    {
        return view('livewire.company.contacts');
    }
}
