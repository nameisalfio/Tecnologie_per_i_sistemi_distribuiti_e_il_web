<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("employees.index", ["employees" => Employee::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("employees.create", ["departments" => Department::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Employee::create($request->all());
        return redirect()->route("employees.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view("employees.show", ["e" => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view("employees.edit", ["e" => $employee, "departments" => Department::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route("employees.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route("employees.index");
    }

    public function increaseSalary(Employee $employee, $percentage)
    {
        $employee->salary = $employee->salary * (1 + $percentage/100);
        $employee->save();
    
        return redirect()->route('employees.show', $employee);
    }
}
