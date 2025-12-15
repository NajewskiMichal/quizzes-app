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
        // Walidacja - klucz do bezpieczeństwa
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable',
            'questions' => 'required|array|min:1', // Wymuś min. 1 pytanie
            'questions.*.content' => 'required',
            'questions.*.option_a' => 'required',
            'questions.*.option_b' => 'required',
            'questions.*.option_c' => 'required',
            'questions.*.option_d' => 'required',
            'questions.*.correct' => 'required|in:a,b,c,d',
        ]);

        // Transakcyjne podejście: Najpierw Quiz, potem powiązane Pytania
        $quiz = Quiz::create(['title' => $data['title'], 'description' => $data['description']]);
        $quiz->questions()->createMany($data['questions']);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz dodany pomyślnie.');
    }

    public function destroy(Quiz $quiz) {
        $quiz->delete();
        return back()->with('success', 'Quiz usunięty.');
    }
}