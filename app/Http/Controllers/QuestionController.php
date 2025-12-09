<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        // Walidacja: wymagamy treści pytania i dokładnie 4 odpowiedzi
        $validated = $request->validate([
            'text'           => ['required', 'string', 'max:255'],
            'answer_1'       => ['required', 'string', 'max:255'],
            'answer_2'       => ['required', 'string', 'max:255'],
            'answer_3'       => ['required', 'string', 'max:255'],
            'answer_4'       => ['required', 'string', 'max:255'],
            'correct_answer' => ['required', 'in:1,2,3,4'], // Musi wskazywać na jedną z 4 opcji
        ], [
            'text.required'           => 'Treść pytania jest wymagana.',
            'correct_answer.required' => 'Musisz zaznaczyć, która odpowiedź jest poprawna.',
        ]);

        // Używamy transakcji DB, aby mieć pewność, że albo zapisze się wszystko 
        DB::transaction(function () use ($request, $quiz, $validated) {
            
            // Automatyczne ustalanie kolejności pytania
            $nextPosition = ($quiz->questions()->max('position') ?? 0) + 1;

            $question = Question::create([
                'quiz_id'  => $quiz->id,
                'text'     => $validated['text'],
                'position' => $nextPosition,
            ]);

            // Pętla tworząca 4 odpowiedzi
            for ($i = 1; $i <= 4; $i++) {
                Answer::create([
                    'question_id' => $question->id,
                    'text'        => $validated["answer_{$i}"],
                    'is_correct'  => (int)$validated['correct_answer'] === $i,
                ]);
            }
        });

        return redirect()
            ->route('quizzes.show', $quiz)
            ->with('status', 'Pytanie zostało dodane do quizu.');
    }
}