@extends('layout')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-2">Sprawdź swoją wiedzę!</h1>
        <p class="text-gray-600">Wybierz quiz poniżej i przetestuj się z geografii.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($quizzes as $quiz)
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300 border border-gray-200">
            <h2 class="text-xl font-bold mb-2 text-blue-600">{{ $quiz->title }}</h2>
            <p class="text-gray-600 mb-4 h-12 overflow-hidden">{{ $quiz->description }}</p>
            <div class="flex justify-between items-center mt-4">
                <span class="text-sm text-gray-500">Pytań: {{ $quiz->questions_count ?? $quiz->questions->count() }}</span>
                <a href="{{ route('quiz.show', $quiz) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-bold">Rozwiąż &rarr;</a>
            </div>
        </div>
        @empty
            <p class="text-center col-span-3 text-gray-500">Brak dostępnych quizów. Zaloguj się jako admin i dodaj pierwszy!</p>
        @endforelse
    </div>
@endsection