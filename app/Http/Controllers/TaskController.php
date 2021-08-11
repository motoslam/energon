<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('tasks.index', compact('user'));
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
