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

        <p class="text-slate-700 mb-6">
            {{ $comment }}
        </p>

        <div class="space-y-4">
            @foreach($questionsWithResult as $row)
                @php
                    /** @var \App\Models\Question $question */
                    $question = $row['question'];
                    $selected = $row['selectedAnswer'];
                    $correct  = $row['correctAnswer'];
                @endphp

                <div class="border border-slate-200 rounded-md p-4">
                    <p class="font-semibold text-slate-800 mb-2">
                        {{ $loop->iteration }}. {{ $question->text }}
                    </p>

                    <p class="text-sm mb-1">
                        Twoja odpowiedź:
                        @if($selected)
                            <strong class="{{ $row['isCorrect'] ? 'text-emerald-700' : 'text-red-700' }}">
                                {{ $selected->text }}
                            </strong>
                        @else
                            <span class="text-red-700 font-semibold">brak odpowiedzi</span>
                        @endif
                    </p>

                    <p class="text-sm text-slate-700">
                        Poprawna odpowiedź:
                        @if($correct)
                            <strong>{{ $correct->text }}</strong>
                        @else
                            <span>brak zdefiniowanej poprawnej odpowiedzi</span>
                        @endif
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
