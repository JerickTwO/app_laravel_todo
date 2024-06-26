<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('tasks', TaskController::class);
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::put('/tasks/{task}/update-position', [TaskController::class, 'updatePosition'])->name('tasks.updatePosition');
});
