<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// --- STREFA PUBLICZNA (Dostępna dla każdego bez logowania) ---
Route::get('/', [PublicController::class, 'index'])->name('home'); // Lista quizów
Route::get('/quiz/{quiz}', [PublicController::class, 'show'])->name('quiz.show'); // Rozwiązywanie
Route::post('/quiz/{quiz}', [PublicController::class, 'check'])->name('quiz.check'); // Sprawdzanie wyniku

// --- LOGOWANIE (Tylko dla administratora) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PANEL ADMINA (Zabezpieczony middlewarem) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Resource tworzy automatycznie trasy: index, create, store, destroy itd.
    Route::resource('quizzes', AdminController::class);
});