<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagazineController;

Route::get('/', function () {
    return view('index');
});

Route::get('/read', [MagazineController::class, 'read']);

Route::post('/insert', [MagazineController::class, 'insert']);

Route::get('/update', function () {
    return view('update');
});

Route::put('/update', [MagazineController::class, 'update']);

Route::delete('/delete', [MagazineController::class, 'delete']);

