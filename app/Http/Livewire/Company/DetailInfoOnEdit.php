<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailInfoOnEdit extends Component
{
    public $company;

    public $show = false;

    public function mount(Company $company, $show)
    {
        $this->company = $company;

        $this->show = $show;
    }

    public function update()
    {
        $this->show = !$this->show;
        Auth::user()->show_detail_company = $this->show;
        Auth::user()->save();
    }

    public function render()
    {
        return view('livewire.company.detail-info-on-edit');
    }
}
