<?php

namespace App\Http\Livewire\Company;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Task;

class CreateTask extends Component
{
    public $company;

    public $user;

    public $name, $content, $deadline, $start, $end;
    public $priority = 'regular';
    public $from_admin = false;
    public $need_confirm = false;

    public function mount($company = null)
    {
        $this->company = $company ?? null;

        $this->user = Auth::user();

        $this->start = '08:00';

        $this->end = '09:00';
    }


    public function create()
    {
        $this->validate([
            'name' => ['required', 'min:5'],
            'start' => ['date_format:H:i'],
            'end' => ['date_format:H:i', 'after:start'],
        ]);

        if (empty($this->deadline))
            $this->deadline = Carbon::now()->format('Y-m-d');

        $user_id = $this->user->id;
        if ($this->company) {
            if ($user_id != $this->company->user_id) {
                $user_id = $this->company->user_id;
                $this->from_admin = true;
            }
        }

        $startTime = Carbon::createFromFormat('Y-m-d H:i', $this->deadline . ' ' . ($this->start ?? '08:00'));
        $endTime = Carbon::createFromFormat('H:i', $this->end ?? '09:00');
        $timer = $startTime->diffInHours($endTime);
        if ($timer == 0) $timer = 1;

        Task::create([
            'user_id' => $user_id,
            'company_id' => $this->company->id ?? null,
            'name' => $this->name,
            'content' => $this->content ?? null,
            'deadline_at' => $startTime,
            'from_admin' => $this->from_admin,
            'need_confirm' => $this->need_confirm,
            'priority' => $this->priority,
            'timer' => $timer
        ]);

        $this->resetInput();

        $this->emit('updateList');
    }

    public function resetInput()
    {
        $this->name = null;
        $this->content = null;
        $this->priority = 'regular';
        $this->deadline = null;
    }

    public function render()
    {
        return view('livewire.company.create-task');
    }
}
