<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboards.manager');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/manager/dashboard', function () {
    return view('dashboards.manager');
})->middleware(['auth', 'verified'])->name('manager.dashboard');

Route::get('/warehouse/dashboard', function () {
    return view('dashboards.warehouse');
})->middleware(['auth', 'verified'])->name('warehouse.dashboard');

Route::get('/supermarket/dashboard', function () {
    return view('dashboards.supermarket');
})->middleware(['auth', 'verified'])->name('supermarket.dashboard');

Route::get('/employee/create', function () {
    return view('auth.register');
})->middleware(['auth', 'verified'])->name('employee.create');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.user');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
