<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Walidacja danych wejściowych
        $validated = $request->validate([
            'text'           => ['required', 'string', 'max:255'],
            'answer_1'       => ['required', 'string', 'max:255'],
            'answer_2'       => ['required', 'string', 'max:255'],
            'answer_3'       => ['required', 'string', 'max:255'],
            'answer_4'       => ['required', 'string', 'max:255'],
            'correct_answer' => ['required', 'in:1,2,3,4'],
        ], [
            'text.required'           => 'Treść pytania jest wymagana.',
            'correct_answer.required' => 'Musisz zaznaczyć, która odpowiedź jest poprawna.',
        ]);

        // Używamy transakcji, aby mieć pewność, że zapisze się wszystko albo nic.
        DB::transaction(function () use ($request, $quiz, $validated) {
            
            // Automatyczne ustalanie kolejności (na koniec listy)
            $nextPosition = ($quiz->questions()->max('position') ?? 0) + 1;

            $question = Question::create([
                'quiz_id'  => $quiz->id,
                'text'     => $validated['text'],
                'position' => $nextPosition,
            ]);

            // Tworzymy 4 odpowiedzi w pętli
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
            ->with('status', 'Pytanie zostało pomyślnie dodane.');
    }

    /**
     * Show the form for editing the specified question.
     */
    public function edit(Question $question)
    {
        // Ładujemy odpowiedzi, aby wyświetlić je w formularzu edycji
        $question->load('answers');

        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'text'           => ['required', 'string', 'max:255'],
            'answer_1'       => ['required', 'string', 'max:255'],
            'answer_2'       => ['required', 'string', 'max:255'],
            'answer_3'       => ['required', 'string', 'max:255'],
            'answer_4'       => ['required', 'string', 'max:255'],
            'correct_answer' => ['required', 'in:1,2,3,4'],
        ], [
            'text.required'           => 'Treść pytania jest wymagana.',
            'correct_answer.required' => 'Musisz zaznaczyć poprawną odpowiedź.',
        ]);

        DB::transaction(function () use ($validated, $question) {
            // 1. Aktualizujemy treść pytania
            $question->update(['text' => $validated['text']]);

            // 2. Aktualizujemy odpowiedzi
            // Sortujemy po ID, żeby zachować kolejność, w jakiej były dodane (odp 1, odp 2...)
            $answers = $question->answers->sortBy('id')->values();

            for ($i = 1; $i <= 4; $i++) {
                // Pobieramy istniejący obiekt odpowiedzi
                $answer = $answers[$i - 1] ?? null;

                if ($answer) {
                    $answer->update([
                        'text'       => $validated["answer_{$i}"],
                        'is_correct' => (int)$validated['correct_answer'] === $i,
                    ]);
                }
            }
        });

        return redirect()
            ->route('quizzes.show', $question->quiz_id)
            ->with('status', 'Pytanie zostało zaktualizowane.');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy(Question $question)
    {
        // Zapamiętujemy ID quizu, żeby wiedzieć gdzie wrócić po usunięciu
        $quizId = $question->quiz_id;
        
        // Dzięki kaskadowemu usuwaniu w migracji, usunięcie pytania usunie też odpowiedzi
        $question->delete();

        return redirect()
            ->route('quizzes.show', $quizId)
            ->with('status', 'Pytanie zostało usunięte.');
    }
}