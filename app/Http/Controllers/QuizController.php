<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the quizzes.
     * Sorts by region and difficulty to make it easier for users to browse.
     */
    public function index()
    {
        // Pobieramy quizy posortowane logicznie dla użytkownika
        $quizzes = Quiz::where('is_published', true) // pokaż tylko opublikowane
            ->orderBy('region')
            ->orderBy('level')
            ->get();

        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new quiz.
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created quiz in database.
     */
    public function store(Request $request)
    {
        // Walidacja z polskimi komunikatami
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'topic'        => ['required', 'string', 'max:100'],
            'region'       => ['nullable', 'string', 'max:100'],
            'level'        => ['required', 'string', 'max:50'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Tytuł quizu jest wymagany.',
            'topic.required' => 'Temat jest wymagany.',
            'level.required' => 'Poziom trudności jest wymagany.',
        ]);


        $validated['is_published'] = $request->has('is_published');

        $quiz = Quiz::create($validated);

        return redirect()
            ->route('quizzes.show', $quiz)
            ->with('status', 'Quiz został pomyślnie utworzony.');
    }

    /**
     * Display the specified quiz details.
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified quiz.
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified quiz in database.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'topic'        => ['required', 'string', 'max:100'],
            'region'       => ['nullable', 'string', 'max:100'],
            'level'        => ['required', 'string', 'max:50'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Tytuł quizu jest wymagany.',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $quiz->update($validated);

        return redirect()
            ->route('quizzes.show', $quiz)
            ->with('status', 'Quiz został zaktualizowany.');
    }

    /**
     * Remove the specified quiz from database.
     */
    public function destroy(Quiz $quiz)
    {
      
        $quiz->delete();

        return redirect()
            ->route('quizzes.index')
            ->with('status', 'Quiz został usunięty.');
    }
}