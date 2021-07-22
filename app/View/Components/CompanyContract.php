<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CompanyContract extends Component
{
    public $company;

    public function __construct($company)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('components.company-contract', ['company' => $this->company]);
    }
}
