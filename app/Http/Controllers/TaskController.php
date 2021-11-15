<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TaskController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('tasks.index', compact('user'));
    }

    public function create(Request $request)
    {
        return abort(404);
    }

    public function store(Request $request)
    {
        return abort(404);
    }

    public function show(Task $task)
    {
        $templateData['task'] = $task;
        $templateData['user'] = Auth::user();
        $templateData['statuses'] = TaskStatus::all();

        return view('tasks.show', $templateData);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function updateStatus()
    {

    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена');
    }

    public function go(Task $task)
    {
        $task->task_status_id = 2;
        $task->save();
        return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Задача в работе');
    }
}
