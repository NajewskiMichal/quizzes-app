<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
        // Pobieramy quizy, ale tylko niezbędne dane (optymalizacja)
        $quizzes = Quiz::withCount('questions')->get();
        return view('public.index', compact('quizzes'));
    }

    public function show(Quiz $quiz) {
        return view('public.solve', compact('quiz'));
    }

    public function check(Request $request, Quiz $quiz) {
        $score = 0;
        $answers = $request->input('answers', []);
        
        // Myślenie krytyczne: Zamiast zapytań SQL w pętli,
        // iterujemy po załadowanej kolekcji pytań (Eager Loading dzieje się automatycznie przez Route Model Binding jeśli tak skonfigurowano, lub tutaj)
        foreach($quiz->questions as $q) {
            if(isset($answers[$q->id]) && $answers[$q->id] === $q->correct) {
                $score++;
            }
        }
        
        // Zwracamy wynik sesją (Flash Message) zamiast zapisywać w bazie - prostota rozwiązania
        return redirect()->route('home')
            ->with('message', "Twój wynik w quizie '{$quiz->title}': $score / " . $quiz->questions->count());
    }
}