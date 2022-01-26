<?php

use App\Http\Controllers\DiscordServersController;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {

    Route::get('/', [HomesController::class, 'top'])
        ->name('homes.top');

    Route::resource('discord-servers', DiscordServersController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('/discord-servers/about', [DiscordServersController::class, 'about'])
        ->name('discord-servers.about');

    Route::resource('users', UsersController::class)
        ->only(['edit', 'update']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::get('/board', [BoardController::class, 'board'])
    ->name('boards.board');

    Route::middleware(['auth'])->group(function () {
        Route::get('/boards/{board}', [BoardController::class, 'show'])
            ->name('boards.show')
            ->where('board', '[0-9]+');

        Route::get('/boards/create', [BoardController::class, 'create'])
            ->name('boards.create');

        Route::post('/boards/store', [BoardController::class, 'store'])
            ->name('boards.store');

        Route::get('/boards/{board}/edit', [BoardController::class, 'edit'])
            ->name('boards.edit')
            ->where('board', '[0-9]+');

        Route::patch('/boards/{board}/update', [BoardController::class, 'update'])
            ->name('boards.update')
            ->where('board', '[0-9]+');

        Route::delete('/boards/{board}/destroy', [BoardController::class, 'destroy'])
            ->name('boards.destroy')
            ->where('board', '[0-9]+');

        Route::post('/boards/{board}/comments', [CommentController::class, 'store'])
            ->name('comments.store')
            ->where('board', '[0-9]+');

        Route::delete('/comments/{comment}/destroy', [CommentController::class, 'destroy'])
            ->name('comments.destroy')
            ->where('comment', '[0-9]+');
    });
});

require __DIR__ . '/auth.php';
