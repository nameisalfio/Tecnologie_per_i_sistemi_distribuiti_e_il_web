<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

Route::get('/', function () {
    return view('index');
});

Route::get('/read', [BooksController::class, 'read']);

Route::post('/create', [BooksController::class, 'create']);

Route::post('/form', [BooksController::class, 'form']);

Route::post('/update', [BooksController::class, 'update']);