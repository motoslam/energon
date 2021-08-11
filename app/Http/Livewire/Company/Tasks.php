<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use Carbon\Carbon;

class Tasks extends Component
{
    public $company;

    public $tasks;

    protected $listeners = ['updateList'];

    public function mount($company)
    {
        $this->company = $company;

        if (!$this->tasks) {
            $this->updateList();
        }
    }

    public function updateList()
    {
        $this->tasks = $this->company->tasks()
            ->get()
            ->groupBy([function ($created) {
                return Carbon::parse($created->deadline_at)->format('Y');
            }, function ($created) {
                return Carbon::parse($created->deadline_at)->format('m');
            }, function ($created) {
                return Carbon::parse($created->deadline_at)->format('d');
            }]);
    }

    public function render()
    {
        return view('livewire.company.tasks');
    }
}
