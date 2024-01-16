<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});

Route::get('/read', [ProductController::class, 'read']);

Route::post('/create', [ProductController::class, 'create']);

Route::post('/form', [ProductController::class, 'form']);

Route::post('/update', [ProductController::class, 'update']);