<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('index');
});

Route::resource('teams', TeamController::class);

Route::resource('players', PlayerController::class);