<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

// Rute untuk menampilkan formulir tugas
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
// Rute untuk menyimpan tugas baru
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Rute untuk memperbarui status tugas
Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

Route::resource('projects', ProjectController::class);


Route::get('/', function () {
    return redirect()->route('projects.index');
});
