<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Halaman utama - daftar film
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Halaman form booking dengan parameter movie_id
Route::get('/booking/{movie_id}', [MovieController::class, 'booking'])->name('movies.booking');

// Halaman ringkasan booking
Route::get('/summary', [MovieController::class, 'summary'])->name('movies.summary');
