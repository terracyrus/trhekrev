<?php

use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\FirstLeaderboardController;
use App\Http\Controllers\OverallLeaderboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('anleitung', function () {
    return redirect()->away('https://www.besj.ch');
})->name('anleitung');

Route::get('dashboard', [OverallLeaderboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('disciplines', [DisciplineController::class, 'index'])->name('disciplines');
    Route::get('disciplines/{discipline:id}', [DisciplineController::class, 'show']);
    Route::get('disciplines/{discipline:id}/edit', [DisciplineController::class, 'edit'])->name('disciplines.edit');
    Route::get('disciplines/{discipline:id}', [DisciplineController::class, 'showLeaderboard'])->name('disciplines.leaderboard');
    Route::put('disciplines/{discipline:id}', [DisciplineController::class, 'update'])->name('disciplines.update');
});

Route::get('firstLeaderboard', [FirstLeaderboardController::class, 'index'])->middleware(['auth', 'verified'])->name('first_leaderboard.index');

Route::get('admin', function () {
    return view('admin');
})->middleware(['auth', 'can:admin-access']);

require __DIR__ . '/auth.php';
