<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

// Strona główna (na razie prosta)
Route::get('/', function () {
    return view('home');
})->name('home');

// Lista quizów
Route::get('/quizzes', [QuizController::class, 'index'])
    ->name('quizzes.index');

// Pojedynczy quiz + pytania
Route::get('/quizzes/{id}', [QuizController::class, 'show'])
    ->name('quizzes.show');
