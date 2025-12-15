@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow-md">
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-blue-800">{{ $quiz->title }}</h1>
        <p class="text-gray-600">{{ $quiz->description }}</p>
    </div>

    <form action="{{ route('quiz.check', $quiz) }}" method="POST">
        @csrf
        @foreach($quiz->questions as $index => $q)
            <div class="mb-8 p-4 bg-gray-50 rounded border border-gray-100">
                <p class="font-bold text-lg mb-3">{{ $index + 1 }}. {{ $q->content }}</p>
                
                <div class="space-y-2">
                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                        <label class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-white rounded border border-transparent hover:border-gray-200 transition">
                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opt }}" class="h-4 w-4 text-blue-600">
                            <span class="text-gray-800"><span class="font-bold uppercase text-gray-500">{{ $opt }})</span> {{ $q->{'option_'.$opt} }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded text-lg transition">
            Zakończ test i sprawdź wynik
        </button>
    </form>
</div>
@endsection