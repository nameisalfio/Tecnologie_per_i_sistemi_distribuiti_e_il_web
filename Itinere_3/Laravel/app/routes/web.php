<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('index');
});

Route::get('/update', function () {
    return view('update');
});

Route::get('/read', [BookController::class, 'read']);

Route::post('/insert', [BookController::class, 'insert']);

Route::put('/update', [BookController::class, 'update']);

Route::delete('/delete', [BookController::class, 'delete']);
