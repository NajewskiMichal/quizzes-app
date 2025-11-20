@extends('layouts.app')

@section('title', 'Lista quizów – GeoAcademy')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-sky-800">
            Lista quizów
        </h1>

        <a href="{{ route('quizzes.create') }}"
           class="bg-sky-700 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-sky-800">
            + Dodaj nowy quiz
        </a>
    </div>

    @if($quizzes->isEmpty())
        <div class="bg-white rounded-md shadow p-4">
            <p class="text-slate-700">Brak quizów w bazie. Dodaj pierwszy quiz, aby rozpocząć.</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 gap-4">
            @foreach($quizzes as $quiz)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-sky-800 mb-1">
                            {{ $quiz->title }}
                        </h2>

                        <p class="text-slate-600 text-sm mb-2">
                            {{ $quiz->description ?: 'Brak opisu.' }}
                        </p>

                        <div class="text-xs text-slate-500 mb-2 flex flex-wrap gap-2">
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
                    </div>

                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('quizzes.show', $quiz) }}"
                           class="text-sm bg-sky-700 text-white px-3 py-1 rounded-md hover:bg-sky-800">
                            Szczegóły
                        </a>

                        <a href="{{ route('quizzes.edit', $quiz) }}"
                           class="text-sm bg-white border border-sky-700 text-sky-800 px-3 py-1 rounded-md hover:bg-sky-50">
                            Edytuj
                        </a>

                        <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST"
                              onsubmit="return confirm('Na pewno chcesz usunąć ten quiz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700">
                                Usuń
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
