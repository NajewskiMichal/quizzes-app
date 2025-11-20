@extends('layouts.app')

@section('title', $quiz->title . ' – GeoAcademy')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-start justify-between gap-4 mb-4">
            <div>
                <h1 class="text-2xl font-bold text-sky-800 mb-1">
                    {{ $quiz->title }}
                </h1>

                <div class="flex flex-wrap gap-2 text-xs mb-2">
                    @if($quiz->topic)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-sky-100 text-sky-800">
                            Temat: {{ $quiz->topic }}
                        </span>
                    @endif

                    @if($quiz->region)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                            Region: {{ $quiz->region }}
                        </span>
                    @endif

                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">
                        Poziom: {{ $quiz->level }}
                    </span>

                    <span class="inline-flex items-center px-2 py-0.5 rounded-full
                                {{ $quiz->is_published ? 'bg-lime-100 text-lime-800' : 'bg-slate-200 text-slate-700' }}">
                        {{ $quiz->is_published ? 'Opublikowany' : 'Szkic' }}
                    </span>
                </div>

                <p class="text-sm text-slate-600">
                    Liczba pytań: <strong>{{ $quiz->questions->count() }}</strong>
                </p>
            </div>

            <div class="flex flex-col gap-2">
                <a href="{{ route('quizzes.edit', $quiz) }}"
                   class="text-sm bg-white border border-sky-700 text-sky-800 px-3 py-1 rounded-md hover:bg-sky-50 text-center">
                    Edytuj quiz
                </a>

                <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST"
                      onsubmit="return confirm('Na pewno chcesz usunąć ten quiz?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-sm bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 w-full">
                        Usuń quiz
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-slate-200 pt-4 mb-4">
            <h2 class="text-lg font-semibold text-slate-800 mb-2">Opis</h2>
            <p class="text-slate-700">
                {{ $quiz->description ?: 'Brak opisu dla tego quizu.' }}
            </p>
        </div>

        <div class="mb-4 flex gap-3">
            @if($quiz->questions->count() > 0)
                <a href="{{ route('quizzes.play', $quiz) }}"
                   class="inline-block bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                    Rozpocznij quiz
                </a>
            @else
                <span class="text-sm text-slate-600 italic pt-2">
                    Ten quiz nie ma jeszcze pytań – dodaj pierwsze pytanie.
                </span>
            @endif

            <a href="{{ route('quizzes.questions.create', $quiz) }}
               "class="inline-block bg-white border border-sky-700 text-sky-800 px-5 py-2 rounded-md text-sm font-semibold hover:bg-sky-50">
                + Dodaj pytanie do tego quizu
            </a>
        </div>

        @if($quiz->questions->count() > 0)
            <div class="border-t border-slate-200 pt-4 mt-4">
                <h2 class="text-lg font-semibold text-slate-800 mb-2">Pytania w tym quizie</h2>

                <div class="space-y-3">
                    @foreach($quiz->questions as $index => $question)
                        <div class="border rounded-md p-3">
                            <p class="font-semibold text-slate-800 mb-1">
                                {{ $index + 1 }}. {{ $question->text }}
                            </p>

                            <ul class="text-sm text-slate-700 list-disc list-inside">
                                @foreach($question->answers as $answerIndex => $answer)
                                    @php
                                        $label = ['A','B','C','D'][$answerIndex] ?? chr(65 + $answerIndex);
                                    @endphp
                                    <li>
                                        <strong>{{ $label }}.</strong>
                                        {{ $answer->text }}
                                        @if($answer->is_correct)
                                            <span class="text-emerald-700 font-semibold">
                                                (poprawna)
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('quizzes.index') }}"
               class="inline-block text-sm text-sky-800 hover:underline">
                &larr; Wróć do listy quizów
            </a>
        </div>
    </div>
@endsection
