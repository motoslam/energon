<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Contacts extends Component
{
    public $company;

    public $contacts;

    public $links;

    public function mount($company)
    {
        $this->company = $company;

        $this->contacts = $company->contacts;

        $this->links = $company->links;
    }

    public function loose($childId, $parentId)
    {
        $parent = Company::find($parentId);

        $parent->links()->detach($childId);

        $this->links = $this->company->links()->get();
    }

    public function render()
    {
        return view('livewire.company.contacts');
    }
}
