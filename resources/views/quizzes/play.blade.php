@extends('layouts.app')

@section('title', 'Rozwiąż quiz – ' . $quiz->title)

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-sky-800 mb-2">
            Rozwiąż quiz: {{ $quiz->title }}
        </h1>

        <p class="text-slate-600 mb-4">
            Odpowiedz na wszystkie pytania, a następnie kliknij przycisk
            <strong>Sprawdź wynik</strong>.
        </p>

        @if($quiz->questions->isEmpty())
            <p class="text-slate-700">
                Ten quiz nie ma jeszcze pytań. Wróć do listy quizów lub wybierz inny.
            </p>

            <a href="{{ route('quizzes.index') }}"
               class="inline-block mt-4 text-sm text-sky-800 hover:underline">
                &larr; Wróć do listy quizów
            </a>
        @else
            <form action="{{ route('quizzes.check', $quiz) }}" method="POST" class="space-y-6">
                @csrf

                @foreach($quiz->questions as $index => $question)
                    <div class="border rounded-md p-4">
                        <p class="font-semibold text-slate-800 mb-2">
                            Pytanie {{ $index + 1 }}:
                            <span class="font-normal">{{ $question->text }}</span>
                        </p>

                        <div class="space-y-1">
                            @foreach($question->answers as $answerIndex => $answer)
                                @php
                                    $label = ['A','B','C','D'][$answerIndex] ?? chr(65 + $answerIndex);
                                @endphp
                                <label class="flex items-center gap-2 text-sm text-slate-700">
                                    <input
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $answer->id }}"
                                        class="h-4 w-4"
                                    >
                                    <span><strong>{{ $label }}.</strong> {{ $answer->text }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 flex gap-3">
                    <button type="submit"
                            class="bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                        Zakończ i sprawdź wynik
                    </button>

                    <a href="{{ route('quizzes.show', $quiz) }}"
                       class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm hover:bg-slate-50">
                        Anuluj
                    </a>
                </div>
            </form>
        @endif
    </div>
@endsection
