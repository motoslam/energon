<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class CreateEvent extends Component
{
    public $company;

    protected $rules = [
        'title' => ['required'],
    ];

    public function mount($company)
    {
        $this->company = $company;
    }

    public function store()
    {
        //$this->validate($this->rules);
        $this->addError('title', 'The email field is invalid.');
    }

    public function render()
    {
        return view('livewire.company.create-event');
    }
}
