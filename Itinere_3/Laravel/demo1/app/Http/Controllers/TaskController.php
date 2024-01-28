<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view("tasks.index", ["tasks" => Task::all()]);
    }

    public function create()
    {
        return view("tasks.create", ["projects" => Project::all()]);
    }

    public function store(Request $request)
    {
        Task::create($request->all());
        return redirect()->route("tasks.index");
    }

    public function show(task $task)
    {
        return view("tasks.show", ["t" => $task]);
    }

    public function edit(task $task)
    {
        return view("tasks.edit", ["t" => $task, "projects" => Project::all()]);
    }

    public function update(Request $request, task $task)
    {
        $task->update($request->all());
        return redirect()->route("tasks.index");
    }

    public function destroy(task $task)
    {
        $task->delete();
        return redirect()->route("tasks.index");
    }
}
