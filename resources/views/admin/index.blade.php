@extends('layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Zarządzanie Quizami</h1>
    <a href="{{ route('admin.quizzes.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-bold">+ Nowy Quiz</a>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm font-bold">
                <th class="px-5 py-3 border-b">Tytuł</th>
                <th class="px-5 py-3 border-b">Opis</th>
                <th class="px-5 py-3 border-b">Liczba pytań</th>
                <th class="px-5 py-3 border-b text-right">Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-5 py-5 text-sm font-bold text-gray-900">{{ $quiz->title }}</td>
                <td class="px-5 py-5 text-sm text-gray-600">{{ Str::limit($quiz->description, 50) }}</td>
                <td class="px-5 py-5 text-sm">{{ $quiz->questions_count }}</td>
                <td class="px-5 py-5 text-sm text-right flex justify-end gap-3">
        <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-blue-600 hover:text-blue-900 font-bold">Edytuj</a>
    
    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten quiz?')" class="inline">
        @csrf @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Usuń</button>
    </form>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($quizzes->isEmpty())
        <div class="p-6 text-center text-gray-500">Brak quizów. Dodaj pierwszy!</div>
    @endif
</div>
@endsection