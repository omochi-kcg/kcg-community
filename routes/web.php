<?php

use App\Http\Controllers\DiscordServersController;
use App\Http\Controllers\HomesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomesController::class, 'top'])
    ->name('homes.top');

Route::resource('discord-servers', DiscordServersController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
Route::get('/about', [HomesController::class, 'about'])
    ->name('homes.about');    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
