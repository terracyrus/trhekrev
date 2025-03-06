<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\FirstLeaderboardController;
use App\Http\Controllers\GamechangerActionController;
use App\Http\Controllers\GamechangerController;
use App\Http\Controllers\OverallLeaderboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('anleitung', function () {
    return redirect()->away('https://besj.ch/besj/ausbildung/teamweekend/jungschi.php');
})->name('anleitung');

Route::get('dashboard', [OverallLeaderboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'can:admin-access')->group(function () {
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
    Route::get('gamechanger', [GamechangerController::class, 'index'])->name('gamechanger.index');
    Route::get('history', [GamechangerActionController::class, 'index'])->name('audit.gamechanger');
    Route::get('history/all', [AuditLogController::class, 'index'])->name('audit.index');
});

Route::middleware('auth', 'can:operator-access')->group(function () {
    Route::get('gamechangerAction', [GamechangerActionController::class, 'create'])->name('gamechanger_actions.create');
    Route::post('gamechangerAction', [GamechangerActionController::class, 'store'])->name('gamechanger_actions.store');
    Route::get('gamechanger/allowed/{user:id}', [GamechangerActionController::class, 'allowedGamechangers']);
});

Route::get('firstLeaderboard', [FirstLeaderboardController::class, 'index'])->middleware(['auth', 'verified'])->name('first_leaderboard.index');

Route::middleware('auth', 'can:admin-access')->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('admin/users/delete-x', [AdminController::class, 'deleteUsers'])->name('admin.users.delete-x');
    Route::delete('admin/game/reset', [AdminController::class, 'resetGame'])->name('admin.game.reset');
    Route::post('admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::put('admin/game/create', [AdminController::class, 'setGame'])->name('admin.game.create');
});

require __DIR__ . '/auth.php';
