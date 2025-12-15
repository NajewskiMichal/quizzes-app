@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Kreator Quizu</h2>

    @if($errors->any())
        <div class="bg-red-50 text-red-700 p-3 mb-4 rounded border border-red-200">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.quizzes.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-bold text-gray-700">Tytuł Quizu</label>
            <input type="text" name="title" class="w-full border p-2 rounded focus:ring focus:ring-blue-200" required value="{{ old('title') }}">
        </div>
        <div class="mb-6">
            <label class="block font-bold text-gray-700">Opis (opcjonalnie)</label>
            <textarea name="description" class="w-full border p-2 rounded focus:ring focus:ring-blue-200" rows="2">{{ old('description') }}</textarea>
        </div>

        <div class="bg-blue-50 p-4 rounded mb-6">
            <h3 class="font-bold text-lg mb-2 text-blue-800">Pytania</h3>
            <div id="questions-container">
                {{-- JS wstawi tu pola --}}
            </div>
            <button type="button" onclick="addQuestion()" class="mt-2 bg-white border border-blue-300 text-blue-700 px-4 py-2 rounded hover:bg-blue-50 font-bold text-sm">+ Dodaj kolejne pytanie</button>
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded text-lg shadow">Zapisz cały quiz</button>
    </form>
</div>

<script>
    let idx = 0;
    function addQuestion() {
        const container = document.getElementById('questions-container');
        const html = `
            <div class="bg-white border border-gray-300 p-4 mb-4 rounded shadow-sm relative">
                <div class="mb-3">
                    <label class="block text-xs font-bold text-gray-500 uppercase">Treść pytania</label>
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
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
                
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 font-bold text-xs">USUŃ</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        idx++;
    }
    // Dodaj pierwsze pytanie na start
    addQuestion();
</script>
@endsection