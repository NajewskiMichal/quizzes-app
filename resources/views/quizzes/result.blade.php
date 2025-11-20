@extends('layouts.app')

@section('title', 'Wynik quizu – ' . $quiz->title)

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-sky-800 mb-2">
            Wynik quizu: {{ $quiz->title }}
        </h1>

        <p class="text-slate-700 mb-2">
            Poprawne odpowiedzi: <strong>{{ $correctCount }}</strong> z
            <strong>{{ $totalQuestions }}</strong>
            ({{ $scorePercent }}%).
        </p>

        <p class="text-slate-700 mb-4 italic">
            {{ $comment }}
        </p>

        <h2 class="text-lg font-semibold text-slate-800 mb-2">
            Szczegóły odpowiedzi
        </h2>

        <div class="space-y-3">
            @foreach($details as $index => $item)
                <div class="border rounded-md p-3">
                    <p class="font-semibold text-slate-800 mb-1">
                        Pytanie {{ $index + 1 }}: {{ $item['question']->text }}
                    </p>

                    <p class="text-sm mb-1">
                        Twoja odpowiedź:
                        @if($item['selectedAnswer'])
                            <span class="{{ $item['isCorrect'] ? 'text-emerald-700' : 'text-red-700' }}">
                                {{ $item['selectedAnswer']->text }}
                                @if($item['isCorrect'])
                                    (poprawna)
                                @else
                                    (niepoprawna)
                                @endif
                            </span>
                        @else
                            <span class="text-slate-500 italic">
                                brak odpowiedzi
                            </span>
                        @endif
                    </p>

                    <p class="text-sm text-slate-700">
                        Poprawna odpowiedź:
                        <strong>{{ $item['correctAnswer']?->text }}</strong>
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('quizzes.play', $quiz) }}"
               class="bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                Rozwiąż ten quiz ponownie
            </a>

            <a href="{{ route('quizzes.index') }}"
               class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm hover:bg-slate-50">
                Wróć do listy quizów
            </a>
        </div>
    </div>
@endsection
