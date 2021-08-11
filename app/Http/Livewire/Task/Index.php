<?php

namespace App\Http\Livewire\Task;

use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $tasks;

    public $model;

    public function mount($model)
    {
        $this->model = $model;

        $this->updateList();
    }

    public function updateList()
    {
        $this->tasks = $this->model->tasks()git
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
        return view('livewire.task.index');
    }
}
