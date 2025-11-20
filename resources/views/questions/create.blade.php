@extends('layouts.app')

@section('title', 'Dodaj pytanie – ' . $quiz->title)

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-sky-800 mb-2">
            Dodaj pytanie do quizu: {{ $quiz->title }}
        </h1>

        <p class="text-slate-600 mb-4 text-sm">
            Uzupełnij treść pytania oraz cztery odpowiedzi (A, B, C, D), a następnie zaznacz, która z nich jest poprawna.
        </p>

        <form action="{{ route('quizzes.questions.store', $quiz) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="text" class="block text-sm font-semibold text-slate-700 mb-1">
                    Treść pytania *
                </label>
                <input type="text" id="text" name="text"
                       value="{{ old('text') }}"
                       class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        Odpowiedź A *
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="correct_answer" value="1"
                               @checked(old('correct_answer', '1') == '1')>
                        <input type="text" name="answer_1"
                               value="{{ old('answer_1') }}"
                               class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        Odpowiedź B *
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="correct_answer" value="2"
                               @checked(old('correct_answer') == '2')>
                        <input type="text" name="answer_2"
                               value="{{ old('answer_2') }}"
                               class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        Odpowiedź C *
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="correct_answer" value="3"
                               @checked(old('correct_answer') == '3')>
                        <input type="text" name="answer_3"
                               value="{{ old('answer_3') }}"
                               class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        Odpowiedź D *
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="correct_answer" value="4"
                               @checked(old('correct_answer') == '4')>
                        <input type="text" name="answer_4"
                               value="{{ old('answer_4') }}"
                               class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-4">
                <button type="submit"
                        class="bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                    Zapisz pytanie
                </button>

                <a href="{{ route('quizzes.show', $quiz) }}"
                   class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm hover:bg-slate-50">
                    Anuluj
                </a>
            </div>
        </form>
    </div>
@endsection
