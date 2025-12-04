<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-seeder', function() {
    Artisan::call('db:seed', ['--class' => 'SubscriberSeeder']);
    return 'Seeder ran successfully!';
});

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/rss', [MessageController::class, 'rss'])->name('messages.rss');

// Admin routes (protected by auth middleware)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [AdminMessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}/edit', [AdminMessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{message}', [AdminMessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Breeze routes (login, register, etc.)
require __DIR__.'/auth.php';