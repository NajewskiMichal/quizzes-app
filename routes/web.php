<?php

use Illuminate\Support\Facades\Route;

// Strona główna
Route::get('/', function () {
    return view('home');
})->name('home');

// Lista quizów
Route::get('/quizzes', function () {
    $quizzes = [
        [
            'id' => 1,
            'title' => 'Stolice Europy – poziom podstawowy',
            'description' => 'Sprawdź, czy znasz stolice najważniejszych państw Europy.',
            'level' => 'łatwy',
            'region' => 'Europa',
        ],
        [
            'id' => 2,
            'title' => 'Stolice świata – poziom rozszerzony',
            'description' => 'Quiz dla ambitnych – stolice mniej oczywistych państw z całego świata.',
            'level' => 'trudny',
            'region' => 'świat',
        ],
        [
            'id' => 3,
            'title' => 'Stolice w Azji',
            'description' => 'Zweryfikuj swoją wiedzę ze stolic krajów azjatyckich.',
            'level' => 'średni',
            'region' => 'Azja',
        ],
    ];

    return view('quizzes', ['quizzes' => $quizzes]);
})->name('quizzes.index');
