<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view("departments.index", ["departments" => Department::all()]);
    }

    public function create()
    {
        return view("departments.create");
    }

    public function store(Request $request)
    {
        Department::create($request->all());
        return redirect()->route("departments.index");
    }

    public function show(Department $department)
    {
        return view("departments.show", ["d" => $department]);
    }

    public function edit(Department $department)
    {
        return view("departments.edit", ["d" => $department]);
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->route("departments.index");
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route("departments.index");
    }
}
