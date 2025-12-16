<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $quizzes = Quiz::withCount('questions')->get();
        return view('admin.index', compact('quizzes'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
        // Walidacja tablicowa dla pytań dynamicznych
        $data = $this->validateQuiz($request);

        // Tworzymy quiz i pytania w jednej transakcji logicznej
        $quiz = Quiz::create(['title' => $data['title'], 'description' => $data['description']]);
        $quiz->questions()->createMany($data['questions']);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz dodany pomyślnie.');
    }

    public function edit(Quiz $quiz) {
        // Dołączamy pytania, aby wypełnić formularz edycji
        $quiz->load('questions');
        return view('admin.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz) {
        $data = $this->validateQuiz($request);

        $quiz->update(['title' => $data['title'], 'description' => $data['description']]);

        // usuwamy stare i wstawiamy nowe. Gwarantuje to spójność danych.
        $quiz->questions()->delete();
        $quiz->questions()->createMany($data['questions']);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz zaktualizowany.');
    }

    public function destroy(Quiz $quiz) {
        // Pytania usuną się kaskadowo
        $quiz->questions()->delete(); 
        $quiz->delete();
        return back()->with('success', 'Quiz usunięty.');
    }

    // Helper do walidacji
    private function validateQuiz($request) {
        return $request->validate([
            'title' => 'required|string',
            'description' => 'nullable',
            'questions' => 'required|array|min:1',
            'questions.*.content' => 'required',
            'questions.*.option_a' => 'required',
            'questions.*.option_b' => 'required',
            'questions.*.option_c' => 'required',
            'questions.*.option_d' => 'required',
            'questions.*.correct' => 'required|in:a,b,c,d',
        ]);
    }
}