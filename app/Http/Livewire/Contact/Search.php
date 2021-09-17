<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Livewire\Component;

class Search extends Component
{
    public $searchQuery;
    public $contacts;

    public function render()
    {
        $searchQuery = '%' . $this->searchQuery . '%';
        $this->contacts = Contact::where('user_id', auth()->user()->getAuthIdentifier())
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', $searchQuery);
            })->get();
        return view('livewire.contact.search');
    }
}
