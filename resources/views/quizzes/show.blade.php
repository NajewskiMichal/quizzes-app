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
            </div>

            <div class="flex flex-col gap-2">
                <a href="{{ route('quizzes.edit', $quiz) }}"
                   class="text-sm bg-white border border-sky-700 text-sky-800 px-3 py-1 rounded-md hover:bg-sky-50 text-center">
                    Edytuj
                </a>

                <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST"
                      onsubmit="return confirm('Na pewno chcesz usunąć ten quiz?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-sm bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 w-full">
                        Usuń
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-slate-200 pt-4">
            <h2 class="text-lg font-semibold text-slate-800 mb-2">Opis</h2>
            <p class="text-slate-700">
                {{ $quiz->description ?: 'Brak opisu dla tego quizu.' }}
            </p>
        </div>

        {{-- Miejsce na przyszłe rozszerzenie, np. liczbę pytań, wyniki, statystyki --}}
        <div class="mt-6 border-t border-slate-200 pt-4">
            <p class="text-sm text-slate-600 italic">
                W kolejnych etapach tutaj pojawi się przycisk <strong>Rozpocznij quiz</strong>
                oraz lista pytań i odpowiedzi.
            </p>
        </div>

        <div class="mt-6">
            <a href="{{ route('quizzes.index') }}"
               class="inline-block text-sm text-sky-800 hover:underline">
                &larr; Wróć do listy quizów
            </a>
        </div>
    </div>
@endsection
