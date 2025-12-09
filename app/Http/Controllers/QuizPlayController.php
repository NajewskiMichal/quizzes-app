<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizPlayController extends Controller
{
    /**
     * Show the quiz form (questions and answers).
     */
    public function showForm(Quiz $quiz)
    {
        // Ładujemy pytania i odpowiedzi, żeby widok miał do nich dostęp
        $quiz->load('questions.answers');

        return view('quizzes.play', [
            'quiz' => $quiz,
        ]);
    }

    /**
     * Process the quiz submission and calculate score.
     */
    public function check(Request $request, Quiz $quiz)
    {
        // Walidacja: sprawdzamy, czy użytkownik odpowiedział na pytania
        // i czy przesłane ID odpowiedzi faktycznie istnieją w bazie.
        $validated = $request->validate([
            'answers'   => ['required', 'array'],
            'answers.*' => ['required', 'integer', 'exists:answers,id'],
        ], [
            'answers.required'   => 'Musisz odpowiedzieć na wszystkie pytania.',
            'answers.*.required' => 'Musisz wybrać odpowiedź.',
            'answers.*.exists'   => 'Wybrana odpowiedź jest nieprawidłowa.',
        ]);

        $quiz->load('questions.answers');
        
        $userAnswers = $validated['answers'];
        $correctCount = 0;
        $questionsWithResult = [];

        foreach ($quiz->questions as $question) {
            // Pobieramy ID odpowiedzi użytkownika dla danego pytania
            $selectedAnswerId = $userAnswers[$question->id] ?? null;

            // Znajdujemy obiekty odpowiedzi
            $selectedAnswer = $question->answers->where('id', $selectedAnswerId)->first();
            $correctAnswer  = $question->answers->where('is_correct', true)->first();

            // Sprawdzamy poprawność
            $isCorrect = $selectedAnswer && $selectedAnswer->is_correct;

            if ($isCorrect) {
                $correctCount++;
            }

            // Zbieramy dane do widoku podsumowania
            $questionsWithResult[] = [
                'question'       => $question,
                'selectedAnswer' => $selectedAnswer,
                'correctAnswer'  => $correctAnswer,
                'isCorrect'      => $isCorrect,
            ];
        }

        // Obliczenie wyniku procentowego 
        $totalQuestions = $quiz->questions->count();
        $scorePercent = $totalQuestions > 0
            ? (int) round(($correctCount / $totalQuestions) * 100)
            : 0;

        // Zapisujemy wynik w bazie 
        QuizResult::create([
            'quiz_id'         => $quiz->id,
            'user_id'         => auth()->id(),
            'correct_answers' => $correctCount,
            'total_questions' => $totalQuestions,
            'score_percent'   => $scorePercent,
        ]);

        // Generujemy motywujący komentarz
        $comment = $this->buildComment($scorePercent);

        return view('quizzes.result', [
            'quiz'                => $quiz,
            'correctCount'        => $correctCount,
            'totalQuestions'      => $totalQuestions,
            'scorePercent'        => $scorePercent,
            'comment'             => $comment,
            'questionsWithResult' => $questionsWithResult,
        ]);
    }

    /**
     * Helper: Returns a feedback message based on score.
     */
    protected function buildComment(int $scorePercent): string
    {
        return match (true) {
            $scorePercent === 100 => 'Perfekcyjnie! Geo-Mistrz!',
            $scorePercent >= 80   => 'Bardzo dobrze! Masz solidną wiedzę.',
            $scorePercent >= 50   => 'Całkiem nieźle, ale warto powtórzyć materiał.',
            $scorePercent > 0     => 'Początki bywają trudne. Spróbuj jeszcze raz!',
            default               => 'Ups! Chyba strzelałeś na oślep? 😉',
        };
    }
}