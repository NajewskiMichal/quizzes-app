<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// Strefa Publiczna
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/quiz/{quiz}', [PublicController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quiz}', [PublicController::class, 'check'])->name('quiz.check');

// Logowanie Administratora
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Panel Administratora - zabezpieczony middlewarem 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('quizzes', AdminController::class);
});