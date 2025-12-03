<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\QuizResult;


class QuizPlayController extends Controller
{
    
    public function showForm(Quiz $quiz)
    {
        
        $quiz->load('questions.answers');

        return view('quizzes.play', [
            'quiz' => $quiz,
        ]);
    }

  
    public function check(Request $request, Quiz $quiz)
    {
        $quiz->load('questions.answers');

   //walidacja
        $validated = $request->validate(
            [
                'answers'   => ['required', 'array'],
                'answers.*' => ['required', 'integer', 'exists:answers,id'],
            ],
            [
                'answers.required'   => 'Musisz odpowiedzieć na wszystkie pytania.',
                'answers.*.required' => 'Musisz wybrać odpowiedź.',
                'answers.*.exists'   => 'Wybrana odpowiedź jest nieprawidłowa.',
            ]
        );

        $userAnswers = $validated['answers'];

        $correctCount   = 0;
        $totalQuestions = $quiz->questions->count();
        $questionsWithResult = [];

        foreach ($quiz->questions as $question) {
            $selectedAnswerId = $userAnswers[$question->id] ?? null;

          
            $selectedAnswer = $question->answers->firstWhere('id', $selectedAnswerId);

           
            $correctAnswer = $question->answers->firstWhere('is_correct', true);

            $isCorrect = $selectedAnswer && $selectedAnswer->is_correct;

            if ($isCorrect) {
                $correctCount++;
            }

            $questionsWithResult[] = [
                'question'       => $question,
                'selectedAnswer' => $selectedAnswer,
                'correctAnswer'  => $correctAnswer,
                'isCorrect'      => $isCorrect,
            ];
        }

        $scorePercent = $totalQuestions > 0
            ? (int) round($correctCount / $totalQuestions * 100)
            : 0;

        $comment = $this->buildComment($scorePercent);
        QuizResult::create([
    'quiz_id'         => $quiz->id,
    'user_id'         => auth()->id(),
    'correct_answers' => $correctCount,
    'total_questions' => $totalQuestions,
    'score_percent'   => $scorePercent,
]);

      
        return view('quizzes.result', [
            'quiz'                => $quiz,
            'correctCount'        => $correctCount,
            'totalQuestions'      => $totalQuestions,
            'scorePercent'        => $scorePercent,
            'comment'             => $comment,
            'questionsWithResult' => $questionsWithResult,
        ]);
    }

    protected function buildComment(int $scorePercent): string
    {
        return match (true) {
            $scorePercent === 100 => 'Perfekcyjnie! Twoja znajomość stolic jest imponująca.',
            $scorePercent >= 80   => 'Bardzo dobrze, to już solidny poziom.',
            $scorePercent >= 50   => 'Całkiem nieźle, ale możesz jeszcze trochę poćwiczyć.',
            $scorePercent > 0     => 'Spokojnie, każdy kiedyś zaczynał – spróbuj jeszcze raz.',
            default               => 'Na razie 0%, ale za drugim razem będzie lepiej 🙂',
        };
    }
}
