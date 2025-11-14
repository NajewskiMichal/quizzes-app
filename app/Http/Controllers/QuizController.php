<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Tymczasowe dane – docelowo pójdą do bazy.
     */
    private function getQuizzes(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Stolice Europy – poziom podstawowy',
                'description' => 'Sprawdź, czy znasz stolice najważniejszych państw Europy.',
                'level' => 'łatwy',
                'region' => 'Europa',
                'questions' => [
                    [
                        'id' => 1,
                        'text' => 'Stolicą Francji jest:',
                        'options' => ['Paryż', 'Lyon', 'Marsylia', 'Nicea'],
                    ],
                    [
                        'id' => 2,
                        'text' => 'Stolicą Niemiec jest:',
                        'options' => ['Berlin', 'Monachium', 'Hamburg', 'Frankfurt'],
                    ],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Stolice świata – poziom rozszerzony',
                'description' => 'Quiz dla ambitnych – stolice mniej oczywistych państw.',
                'level' => 'trudny',
                'region' => 'świat',
                'questions' => [
                    [
                        'id' => 1,
                        'text' => 'Stolicą Australii jest:',
                        'options' => ['Canberra', 'Sydney', 'Melbourne', 'Perth'],
                    ],
                    [
                        'id' => 2,
                        'text' => 'Stolicą Kanady jest:',
                        'options' => ['Ottawa', 'Toronto', 'Montreal', 'Vancouver'],
                    ],
                ],
            ],
        ];
    }

    public function index()
    {
        $quizzes = $this->getQuizzes();

        return view('quizzes.index', compact('quizzes'));
    }

    public function show(int $id)
    {
        $quiz = collect($this->getQuizzes())->firstWhere('id', $id);

        if (! $quiz) {
            abort(404);
        }

        return view('quizzes.show', compact('quiz'));
    }
}
