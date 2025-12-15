@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 class="text-2xl font-bold">Edycja Quizu: {{ $quiz->title }}</h2>
        <a href="{{ route('admin.quizzes.index') }}" class="text-gray-500 hover:underline">Anuluj</a>
    </div>

    <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
        @csrf @method('PUT') <!-- Metoda PUT jest wymagana przez Laravel do aktualizacji Resource -->
        
        <div class="mb-4">
            <label class="block font-bold text-gray-700">Tytuł Quizu</label>
            <input type="text" name="title" class="w-full border p-2 rounded" value="{{ old('title', $quiz->title) }}" required>
        </div>
        
        <div class="mb-6">
            <label class="block font-bold text-gray-700">Opis</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="2">{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div class="bg-blue-50 p-4 rounded mb-6">
            <h3 class="font-bold text-lg mb-4 text-blue-800">Pytania w tym quizie</h3>
            <div id="questions-container">
                {{-- Wyświetlamy istniejące pytania przy starcie strony --}}
                @foreach($quiz->questions as $index => $q)
                <div class="bg-white border border-gray-300 p-4 mb-4 rounded shadow-sm relative">
                    <div class="mb-3">
                        <label class="block text-xs font-bold text-gray-500 uppercase">Treść pytania</label>
                        <input name="questions[{{ $index }}][content]" class="w-full border-b border-gray-300 p-2 font-bold" value="{{ $q->content }}" required>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div><span class="font-bold text-gray-400">A)</span> <input name="questions[{{ $index }}][option_a]" class="border p-1 rounded w-11/12" value="{{ $q->option_a }}" required></div>
                        <div><span class="font-bold text-gray-400">B)</span> <input name="questions[{{ $index }}][option_b]" class="border p-1 rounded w-11/12" value="{{ $q->option_b }}" required></div>
                        <div><span class="font-bold text-gray-400">C)</span> <input name="questions[{{ $index }}][option_c]" class="border p-1 rounded w-11/12" value="{{ $q->option_c }}" required></div>
                        <div><span class="font-bold text-gray-400">D)</span> <input name="questions[{{ $index }}][option_d]" class="border p-1 rounded w-11/12" value="{{ $q->option_d }}" required></div>
                    </div>

                    <div class="flex items-center">
                        <label class="mr-2 text-sm font-bold">Poprawna odpowiedź:</label>
                        <select name="questions[{{ $index }}][correct]" class="border p-1 rounded bg-gray-50">
                            @foreach(['a','b','c','d'] as $letter)
                                <option value="{{ $letter }}" {{ $q->correct == $letter ? 'selected' : '' }}>{{ strtoupper($letter) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 font-bold text-xs">USUŃ</button>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addQuestion()" class="mt-2 bg-white border border-blue-300 text-blue-700 px-4 py-2 rounded hover:bg-blue-50 font-bold text-sm">+ Dodaj kolejne pytanie</button>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded text-lg shadow transition">Zapisz zmiany w quizie</button>
    </form>
</div>

<script>
    // Inicjalizujemy licznik na podstawie istniejących już pytań
    let idx = {{ $quiz->questions->count() }};
    
    function addQuestion() {
        const container = document.getElementById('questions-container');
        const html = `
            <div class="bg-white border border-gray-300 p-4 mb-4 rounded shadow-sm relative">
                <div class="mb-3">
                    <label class="block text-xs font-bold text-gray-500 uppercase">Nowe pytanie</label>
                    <input name="questions[${idx}][content]" class="w-full border-b border-gray-300 p-2 focus:outline-none focus:border-blue-500 font-bold" placeholder="Wpisz pytanie..." required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                    <div><span class="font-bold text-gray-400">A)</span> <input name="questions[${idx}][option_a]" class="border p-1 rounded w-11/12" required></div>
                    <div><span class="font-bold text-gray-400">B)</span> <input name="questions[${idx}][option_b]" class="border p-1 rounded w-11/12" required></div>
                    <div><span class="font-bold text-gray-400">C)</span> <input name="questions[${idx}][option_c]" class="border p-1 rounded w-11/12" required></div>
                    <div><span class="font-bold text-gray-400">D)</span> <input name="questions[${idx}][option_d]" class="border p-1 rounded w-11/12" required></div>
                </div>
                <div class="flex items-center">
                    <label class="mr-2 text-sm font-bold">Poprawna odpowiedź:</label>
                    <select name="questions[${idx}][correct]" class="border p-1 rounded bg-gray-50">
                        <option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option>
                    </select>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 font-bold text-xs">USUŃ</button>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        idx++;
    }
</script>
@endsection