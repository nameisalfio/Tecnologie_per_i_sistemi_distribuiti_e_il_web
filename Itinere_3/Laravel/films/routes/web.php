<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', function () {
    return view('index');
});

Route::get('/read', [FilmController::class, 'ReadAllFilms']);

Route::post('/insert', [FilmController::class, 'CreateFilm']);

Route::get('/update', function () {
    return view('update');
});

Route::put('/update', [FilmController::class, 'UpdateFilm']);

Route::delete('/delete', [FilmController::class, 'DeleteFilm']);