<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use App\Models\CompanyStatus;
use App\Models\CompanyType;
use App\Models\Potentiality;
use Livewire\Component;
use App\Http\Livewire\Traits\TrimStrings;

class Detail extends Component
{
    use TrimStrings;

    public $company;

    /** Опции открытия форм редактирования */
    public $optionEditDescription = false;

    /** Редактируемые свойства */
    public $companyDescription;

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function toggleEditDescription()
    {
        $this->companyDescription = $this->company->description;

        $this->optionEditDescription = !$this->optionEditDescription;
    }

    public function closeEditDescription()
    {
        $this->companyDescription = $this->company->description;

        $this->optionEditDescription = false;
    }

    public function saveDescription()
    {
        $this->convertEmptyToNull('companyDescription', $this->companyDescription);

        $this->company->description = $this->companyDescription;

        $this->company->save();

        $this->toggleEditDescription();
    }

    public function render()
    {
        return view('livewire.company.detail');
    }
}
