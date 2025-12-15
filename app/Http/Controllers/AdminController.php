<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Wyświetlanie listy quizów
    public function index() {
        $quizzes = Quiz::withCount('questions')->get();
        return view('admin.index', compact('quizzes'));
    }

    // Formularz dodawania
    public function create() {
        return view('admin.create');
    }

    // Zapisywanie quizu
    public function store(Request $request) {
        $data = $request->validate([
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

        $quiz = Quiz::create(['title' => $data['title'], 'description' => $data['description']]);
        $quiz->questions()->createMany($data['questions']);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz dodany pomyślnie.');
    }

    // Usuwanie quizu
    public function destroy(Quiz $quiz) {
        $quiz->delete();
        return back()->with('success', 'Quiz usunięty.');
    }

    // Wyświetlenie formularza edycji z załadowanymi pytaniami
    public function edit(Quiz $quiz) {
        $quiz->load('questions'); // Eager loading - optymalizacja zapytań
        return view('admin.edit', compact('quiz'));
    }

    // Proces aktualizacji danych w bazie
    public function update(Request $request, Quiz $quiz) {
        $data = $request->validate([
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

        // 1. Aktualizacja danych podstawowych quizu
        $quiz->update([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        // 2. Strategiczne odświeżenie pytań: czyścimy stare i zapisujemy zestaw na nowo
        // Dzięki temu unikamy konfliktów ID i skomplikowanej logiki synchronizacji
        $quiz->questions()->delete();
        $quiz->questions()->createMany($data['questions']);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz zaktualizowany pomyślnie.');
    }
}