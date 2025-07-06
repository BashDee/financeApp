<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\WantController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('home');

Route::get('dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/needs', [NeedController::class, 'index'])->name('needs.index');
    Route::post('/needs', [NeedController::class, 'store'])->name('needs.store');
    Route::get('/wants', [WantController::class, 'index'])->name('wants.index');
    Route::post('/wants', [WantController::class, 'store'])->name('wants.store');
    Route::delete('/needs/{need}', [NeedController::class, 'destroy'])->name('needs.destroy');
    Route::delete('/wants/{want}', [WantController::class, 'destroy'])->name('wants.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
