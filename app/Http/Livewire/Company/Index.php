<?php

namespace App\Http\Livewire\Company;

use App\Models\CompanyStatus;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $companies = '';
    public $companyStatuses;
    public $search;
    public $status;

    protected $listeners = ['searchUpdated', 'statusUpdated'];

    public function mount()
    {
        $this->companyStatuses = CompanyStatus::allowed();
    }

    public function statusUpdated($value)
    {
        $this->status = $value;
    }

    public function searchUpdated($value)
    {
        $this->search = $value;
    }

    public function render()
    {
        if (mb_substr($this->search, 0, 6, 'UTF-8') == 'start:') {
            $searchTerm = mb_substr($this->search, 6, NULL, 'UTF-8') . '%';
        } else {
            $searchTerm = '%' . $this->search . '%';
        }

        $this->companies = Company::where('user_id', '=', Auth::user()->id)
            ->where(function ($query){
                if($this->status) {
                    $query->where('company_status_id', '=', $this->status);
                }
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('ssn', 'like', $searchTerm)
                    ->orWhere('legal', 'like', $searchTerm);
            })
            ->get();

        return view('livewire.company.index');
    }
}
