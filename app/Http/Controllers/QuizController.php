<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pokazujemy opublikowane quizy, najpierw po regionie, potem po tytule
        $quizzes = Quiz::orderBy('region')
            ->orderBy('level')
            ->orderBy('title')
            ->get();

        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic'       => ['required', 'string', 'max:100'],
            'region'      => ['nullable', 'string', 'max:100'],
            'level'       => ['required', 'string', 'max:50'],
            'is_published'=> ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->has('is_published');

        $quiz = Quiz::create($validated);

        return redirect()
            ->route('quizzes.show', $quiz)
            ->with('status', 'Quiz has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic'       => ['required', 'string', 'max:100'],
            'region'      => ['nullable', 'string', 'max:100'],
            'level'       => ['required', 'string', 'max:50'],
            'is_published'=> ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->has('is_published');

        $quiz->update($validated);

        return redirect()
            ->route('quizzes.show', $quiz)
            ->with('status', 'Quiz has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()
            ->route('quizzes.index')
            ->with('status', 'Quiz has been deleted.');
    }
}
