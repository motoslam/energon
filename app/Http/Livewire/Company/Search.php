<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Search extends Component
{
    public $searchQuery;

    public function updatedSearchQuery($value)
    {
        $this->emit('searchUpdated', $value);
    }

    public function render()
    {
        return view('livewire.company.search');
    }
}
