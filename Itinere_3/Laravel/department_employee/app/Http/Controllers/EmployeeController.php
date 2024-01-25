<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class EmployeeController extends Controller
{
    public function index()
    {
        return view("employees.index", ["employees" => Employee::all()]);
    }

    public function create()
    {
        return view("employees.create", ["departments" => Department::all()]);
    }

    public function store(Request $request)
    {
        Employee::create($request->all());
        return redirect()->route("employees.index");
    }

    public function show(Employee $employee)
    {
        return view("employees.show", ["e" => $employee]);
    }

    public function edit(Employee $employee)
    {
        return view("employees.edit", ["e" => $employee, "departments" => Department::all()]);
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route("employees.index");
    }

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
