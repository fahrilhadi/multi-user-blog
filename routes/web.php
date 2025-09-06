<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\DashboardController;

Route::get('/', [PostController::class, 'index']);

Route::resource('posts', PostController::class);

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/posts/{id}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
});

require __DIR__.'/auth.php';
