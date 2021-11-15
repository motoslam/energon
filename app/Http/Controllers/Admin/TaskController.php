<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        $data['statuses'] = TaskStatus::all();
        $data['tasks'] = Task::all()->groupBy('task_status_id');
        return view('admin.tasks.index', $data);
    }

    public function create()
    {
        $data['users'] = User::all();
        return view('admin.tasks.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            /*'user_id' => ['sometimes', 'exists:users,id'],
            'company_id' => ['sometimes', 'exists:companies,id'],*/
        ]);

        $user_id = $request->user_id ?? auth()->user()->id;

        $datetime = null;
        if($request->deadline) {
            $str = $request->deadline . ' ' . $request->deadline_time;
            $datetime = Carbon::createFromFormat('Y-m-d H:i', $str)->toDateTimeString();
        }

        $task = Task::create([
            'name' => $request->name,
            'user_id' => $user_id,
            'senior_id' => ($user_id != auth()->user()->id) ? auth()->user()->id : null,
            'company_id' => $request->company_id,
            'content' => $request->data,
            'task_status_id' => 1,
            'priority_id' => $request->priority_id,
            'need_confirm' => true,
            'deadline_at' => $datetime,
        ]);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Задача #' . $task->id . ' добавлена');
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
