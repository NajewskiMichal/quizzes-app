<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizPlayController;
use App\Http\Controllers\QuestionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Quiz CRUD
Route::resource('quizzes', QuizController::class);

// Rozwiązywanie quizu
Route::get('/quizzes/{quiz}/play', [QuizPlayController::class, 'showForm'])
    ->name('quizzes.play');

Route::post('/quizzes/{quiz}/play', [QuizPlayController::class, 'check'])
    ->name('quizzes.check');

// Dodawanie pytań do quizów
Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])
    ->name('quizzes.questions.create');

Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])
    ->name('quizzes.questions.store');
