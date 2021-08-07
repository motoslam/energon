<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use App\Models\CompanyStatus;
use Livewire\Component;

class Status extends Component
{
    public $company;

    public $companyStatuses;

    public $status_id;

    public $status_name;

    public $status;

    public function mount(Company $company)
    {
        $this->company = $company;

        $this->companyStatuses = CompanyStatus::all();

        $this->status = $company->companyStatus;

        $this->status_name = $company->companyStatus->name;
    }

    public function updatedStatusId()
    {
        $this->status = CompanyStatus::find($this->status_id);

        $this->company->company_status_id = $this->status_id;

        $this->company->save();
    }

    public function render()
    {
        return view('livewire.company.status');
    }
}
