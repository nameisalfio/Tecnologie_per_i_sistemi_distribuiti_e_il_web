<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view("projects.index", ["projects" => Project::all()]);
    }

    public function create()
    {
        return view("projects.create");
    }

    public function store(Request $request)
    {
        Project::create($request->all());
        return redirect()->route("projects.index");
    }

    public function show(Project $project)
    {
        return view("projects.show", ["p" => $project]);
    }

    public function edit(Project $project)
    {
        return view("projects.edit", ["p" => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return redirect()->route("projects.index");
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("projects.index");
    }
}
