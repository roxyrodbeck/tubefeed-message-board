<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/messages', [MessageController::class, 'index'])
    ->name('messages.index');
Route::get('/messages/rss', [MessageController::class, 'rss'])
    ->name('messages.rss');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/messages', [AdminMessageController::class, 'index'])
        ->name('messages.index');
    Route::get('/messages/create', [AdminMessageController::class, 'create'])
        ->name('messages.create');
    Route::post('/messages', [AdminMessageController::class, 'store'])
        ->name('messages.store');
    Route::get('/messages/{message}/edit', [AdminMessageController::class, 'edit'])
        ->name('messages.edit');
    Route::put('/messages/{message}', [AdminMessageController::class, 'update'])
        ->name('messages.update');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])
        ->name('messages.destroy');
});

require __DIR__.'/auth.php';
