<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web & API Routes
|--------------------------------------------------------------------------
*/

// Main Profile & Portfolio Frontend
Route::get('/', [ProfileController::class, 'index'])->name('home');

// Admin Control Panel
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Contact API
Route::post('/api/contact', [ProfileController::class, 'storeContact'])->name('api.contact');

// Projects CRUD API
Route::post('/api/projects', [AdminController::class, 'storeProject'])->name('api.projects.store');
