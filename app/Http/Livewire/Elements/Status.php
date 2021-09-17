<?php

namespace App\Http\Livewire\Elements;

use Livewire\Component;
use App\Models\CompanyStatus;

class Status extends Component
{
    public $status;

    public $short;

    public $name;

    public function mount(CompanyStatus $status, $short = true)
    {
        $this->status = $status;
        $this->short = $short;
    }

    public function render()
    {
        $this->name = $this->short ? $this->status->short_name : $this->status->name;

        return view('livewire.elements.status');
    }
}
