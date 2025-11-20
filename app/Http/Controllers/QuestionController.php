<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Show form for creating a new question for given quiz.
     */
    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    /**
     * Store new question with its answers for given quiz.
     */
    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'text'           => ['required', 'string', 'max:255'],
            'answer_1'       => ['required', 'string', 'max:255'],
            'answer_2'       => ['required', 'string', 'max:255'],
            'answer_3'       => ['required', 'string', 'max:255'],
            'answer_4'       => ['required', 'string', 'max:255'],
            'correct_answer' => ['required', 'in:1,2,3,4'],
        ]);

        $nextPosition = ($quiz->questions()->max('position') ?? 0) + 1;

        $question = Question::create([
            'quiz_id'  => $quiz->id,
            'text'     => $validated['text'],
            'position' => $nextPosition,
        ]);

        for ($i = 1; $i <= 4; $i++) {
            Answer::create([
                'question_id' => $question->id,
                'text'        => $validated["answer_{$i}"],
                'is_correct'  => (int)$validated['correct_answer'] === $i,
            ]);
        }

        return redirect()
            ->route('quizzes.show', $quiz)
            ->with('status', 'Question has been added to the quiz.');
    }
}
