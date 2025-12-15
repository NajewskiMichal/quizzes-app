<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class UserQuizController extends Controller
{
    public function index()
    {
        // Uczeń widzi tylko listę dostępnych testów
        $quizzes = Quiz::withCount('questions')->get();
        return view('user.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        return view('user.show', compact('quiz'));
    }

    public function solve(Request $request, Quiz $quiz)
    {
        $score = 0;
        $answers = $request->input('answers', []);

        // Prosta pętla sprawdzająca: iterujemy po pytaniach i porównujemy z przesłaną odpowiedzią
        foreach ($quiz->questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->correct) {
                $score++;
            }
        }

        return redirect()->route('quizzes.index')
            ->with('status', "Twój wynik z geografii: $score / " . $quiz->questions->count());
    }
}