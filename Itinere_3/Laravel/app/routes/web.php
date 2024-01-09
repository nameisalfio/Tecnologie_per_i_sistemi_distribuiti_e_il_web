<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('index');
});

Route::get('/books', [BookController::class, 'read']);
Route::post('/books', [BookController::class, 'insert']);
Route::get('/books/form', [BookController::class, 'showForm']);
Route::put('/books/update', [BookController::class, 'update']);
Route::delete('/books/delete', [BookController::class, 'delete']);
