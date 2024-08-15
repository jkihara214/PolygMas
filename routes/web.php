<?php

use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/lang/setting', [LanguageController::class, 'edit'])->name('lang.setting.edit');
    Route::patch('/lang/setting', [LanguageController::class, 'update'])->name('lang.setting.update');

    Route::get('/diary/register', [DiaryController::class, 'create'])->name('diary.register');
    Route::post('/diary/register', [DiaryController::class, 'store'])->name('diary.register');
});

Route::get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [AdminAdminController::class, 'index'])->name('index');
    Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
    Route::get('/lang', [AdminLanguageController::class, 'index'])->name('lang.index');
    Route::get('/lang/register', [AdminLanguageController::class, 'create'])->name('lang.register');
    Route::post('/lang/register', [AdminLanguageController::class, 'store'])->name('lang.register');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin_auth.php';
