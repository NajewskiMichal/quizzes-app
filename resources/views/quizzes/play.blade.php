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

        {{-- Błędy walidacji --}}
        @if($errors->any())
            <div class="mb-4 rounded-md bg-red-50 border border-red-200 p-3 text-sm text-red-700">
                <p class="font-semibold mb-1">Wystąpiły błędy:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($quiz->questions->isEmpty())
            <p class="text-slate-500">
                Ten quiz nie ma jeszcze żadnych pytań.
            </p>
        @else
            <form action="{{ route('quizzes.check', $quiz) }}" method="POST" class="space-y-6">
                @csrf

                @foreach($quiz->questions as $question)
                    <fieldset class="border border-slate-200 rounded-md p-4">
                        <legend class="font-semibold text-slate-800 mb-2">
                            {{ $loop->iteration }}. {{ $question->text }}
                        </legend>

                        {{-- Błąd dla konkretnego pytania --}}
                        @error('answers.' . $question->id)
                            <p class="text-sm text-red-600 mb-2">{{ $message }}</p>
                        @enderror

                        <div class="space-y-2">
                            @foreach($question->answers as $answer)
                                <label class="flex items-center gap-2">
                                    <input
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $answer->id }}"
                                        @checked(old('answers.' . $question->id) == $answer->id)
                                        required
                                    >
                                    <span>{{ $answer->text }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach

                <div class="mt-6 flex gap-3">
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
