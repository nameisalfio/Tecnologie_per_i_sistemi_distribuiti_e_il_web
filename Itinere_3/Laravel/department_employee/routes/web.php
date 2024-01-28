<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("departments", DepartmentController::class);
Route::resource("employees", EmployeeController::class);
Route::get('employees/increaseSalary/{employee}/{percentage}', [EmployeeController::class, 'increaseSalary'])->name('employees.increaseSalary');
