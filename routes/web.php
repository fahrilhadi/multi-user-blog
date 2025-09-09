<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\DashboardController;

Route::get('/', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class)->except(['index','show']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/posts/{post:slug}', [AdminController::class, 'show'])->name('admin.posts.show');
    Route::delete('/admin/posts/{id}', [AdminController::class, 'destroy'])->name('admin.posts.destroy');
    Route::post('/admin/posts/{id}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
    Route::post('/admin/posts/{id}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
});

require __DIR__.'/auth.php';