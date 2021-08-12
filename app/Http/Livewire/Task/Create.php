<?php

namespace App\Http\Livewire\Task;

use App\Models\Company;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class Create extends Component
{
    public $company;

    public $user;

    public $name;

    public $content;

    public $deadline;

    public $time;

    public $priority_id;

    public $need_confirm;

    public function mount(Request $request, $company = null)
    {
        $this->company = $company ?? null;

        $this->user = Auth::user();

        $this->priority_id = 'regular';

        $this->need_confirm = false;

        $this->deadline = now()->format('Y-m-d');

        $this->time = '08:00';
    }

    public function create()
    {
        $this->validate([
            'name' => ['required'],
            'deadline' => ['date_format:Y-m-d'],
            'time' => ['date_format:H:i'],
        ], [
            'name.required' => 'Введите заголовок задачи',
            'deadline.date_format' => 'Формат даты не соответствует ожидаемому',
            'time.date_format' => 'Формат времени не соответствует ожидаемому',
        ]);

        if (empty($this->deadline))
            $this->deadline = Carbon::now()->format('Y-m-d');

        $user_id = $this->user->id;
        if ($this->company) {
            if ($user_id != $this->company->user_id) {
                $user_id = $this->company->user_id;
            }
        }

        $deadlineDateTime = Carbon::createFromFormat('Y-m-d H:i', $this->deadline . ' ' . ($this->time ?? '08:00'));

        $task = Task::create([
            'user_id' => $user_id,
            'company_id' => $this->company->id ?? null,
            'name' => $this->name,
            'content' => $this->content ?? null,
            'deadline_at' => $deadlineDateTime,
            'need_confirm' => $this->need_confirm,
            'priority_id' => $this->priority_id,
        ]);

        $this->resetInput();

        $this->emit('updateList');

        $this->emit('showSuccess', 'Задача успешно создана.');
    }

    public function resetInput()
    {
        $this->name = null;
        $this->content = null;
        $this->priority_id = 'regular';
        $this->deadline = null;
        $this->time = '08:00';
    }

    public function render()
    {
        return view('livewire.task.create');
    }
}
