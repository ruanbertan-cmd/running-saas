<?php

use App\Http\Controllers\AthleteDashboardController;
use App\Http\Controllers\CoachDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/coach/dashboard', [CoachDashboardController::class, 'index'])
    ->middleware(['auth', 'role:coach'])
    ->name('coach.dashboard');

Route::get('/coach/athletes/{athlete}', [CoachDashboardController::class, 'athlete'])
    ->middleware(['auth', 'role:coach'])
    ->name('coach.athlete');

Route::get('/athlete/dashboard', [AthleteDashboardController::class, 'index'])
    ->middleware(['auth', 'role:athlete'])
    ->name('athlete.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
