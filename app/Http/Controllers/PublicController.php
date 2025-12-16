<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
        // Pobieramy quizy
        $quizzes = Quiz::withCount('questions')->get();
        return view('public.index', compact('quizzes'));
    }

    public function show(Quiz $quiz) {
        return view('public.solve', compact('quiz'));
    }

    public function check(Request $request, Quiz $quiz) {
        $score = 0;
        $answers = $request->input('answers', []);
        
        // iterujemy po załadowanej kolekcji pytań
        foreach($quiz->questions as $q) {
            if(isset($answers[$q->id]) && $answers[$q->id] === $q->correct) {
                $score++;
            }
        }
        
        // Zwracamy wynik sesją
        return redirect()->route('home')
            ->with('message', "Twój wynik w quizie '{$quiz->title}': $score / " . $quiz->questions->count());
    }
}