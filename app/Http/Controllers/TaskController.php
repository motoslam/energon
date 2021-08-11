<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        return view('tasks.index');
    }

    public function create(Request $request)
    {
        $templateData['company'] = Company::find($request->get('company'));
        $templateData['btnText'] = 'Создать задачу';

        return view('tasks.create', $templateData);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
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
