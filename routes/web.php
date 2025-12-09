<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizPlayController;
use App\Http\Controllers\QuestionController;


// Strona główna
Route::get('/', [HomeController::class, 'index'])->name('home');

// CRUD dla Quizów 

Route::resource('quizzes', QuizController::class);

// Grupa tras do rozwiązywania quizów 
Route::controller(QuizPlayController::class)->group(function () {
    Route::get('/quizzes/{quiz}/play', 'showForm')->name('quizzes.play');
    Route::post('/quizzes/{quiz}/play', 'check')->name('quizzes.check');
});

// Grupa tras do zarządzania pytaniami
Route::controller(QuestionController::class)->group(function () {
    Route::get('/quizzes/{quiz}/questions/create', 'create')->name('quizzes.questions.create');
    Route::post('/quizzes/{quiz}/questions', 'store')->name('quizzes.questions.store');
});