<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizPlayController extends Controller
{
    /**
     * Show quiz questions and answers form.
     */
    public function showForm(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('quizzes.play', compact('quiz'));
    }

    /**
     * Check user answers and display result.
     */
    public function check(Request $request, Quiz $quiz)
    {
        $quiz->load('questions.answers');

        $submitted = $request->input('answers', []); // answers[question_id] = answer_id

        $totalQuestions = $quiz->questions->count();
        $correctCount   = 0;
        $details        = [];

        foreach ($quiz->questions as $question) {
            $selectedAnswerId = $submitted[$question->id] ?? null;
            $selectedAnswer   = null;

            if ($selectedAnswerId) {
                $selectedAnswer = $question->answers->firstWhere('id', (int)$selectedAnswerId);
            }

            $correctAnswer = $question->answers->firstWhere('is_correct', true);
            $isCorrect     = $selectedAnswer && $selectedAnswer->is_correct;

            if ($isCorrect) {
                $correctCount++;
            }

            $details[] = [
                'question'       => $question,
                'selectedAnswer' => $selectedAnswer,
                'correctAnswer'  => $correctAnswer,
                'isCorrect'      => $isCorrect,
            ];
        }

        $scorePercent = $totalQuestions > 0
            ? round($correctCount / $totalQuestions * 100)
            : 0;

        $comment = $this->buildComment($scorePercent);

        return view('quizzes.result', [
            'quiz'           => $quiz,
            'totalQuestions' => $totalQuestions,
            'correctCount'   => $correctCount,
            'scorePercent'   => $scorePercent,
            'details'        => $details,
            'comment'        => $comment,
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
