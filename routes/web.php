<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypingController;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\StatisticsController;
Route::get('/', function () {
    return view('welcome');
});
///

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [Dashboard_Controller::class, 'index'])->name('dashboard');
Route::get('/statistics' , [StatisticsController::class , 'index'])->name('statistics');
    Route::get('/typing', [TypingController::class, 'index'])->name('typing');
    Route::post('/typing/complete', [TypingController::class, 'complete'])->name('typing.complete');
    Route::get('/practice', [PracticeController::class, 'index'])->name('practice');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
});

///

Route::middleware('auth')->group(function () {
    Route::get('/user', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
