@extends('layouts.app')

@section('title', 'Edytuj quiz – GeoAcademy')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-sky-800 mb-4">
            Edytuj quiz: {{ $quiz->title }}
        </h1>

        <form action="{{ route('quizzes.update', $quiz) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">
                    Tytuł quizu *
                </label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $quiz->title) }}"
                       class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">
                    Opis
                </label>
                <textarea id="description" name="description" rows="3"
                          class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">{{ old('description', $quiz->description) }}</textarea>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label for="topic" class="block text-sm font-semibold text-slate-700 mb-1">
                        Temat *
                    </label>
                    <input type="text" id="topic" name="topic"
                           value="{{ old('topic', $quiz->topic) }}"
                           class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>

                <div>
                    <label for="region" class="block text-sm font-semibold text-slate-700 mb-1">
                        Region
                    </label>
                    <input type="text" id="region" name="region"
                           value="{{ old('region', $quiz->region) }}"
                           class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>

                <div>
                    <label for="level" class="block text-sm font-semibold text-slate-700 mb-1">
                        Poziom trudności *
                    </label>
                    <select id="level" name="level"
                            class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                        @foreach(['łatwy','średni','trudny'] as $level)
                            <option value="{{ $level }}" @selected(old('level', $quiz->level) === $level)>
                                {{ ucfirst($level) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_published" name="is_published"
                       value="1" @checked(old('is_published', $quiz->is_published))>
                <label for="is_published" class="text-sm text-slate-700">
                    Quiz jest opublikowany (widoczny na liście)
                </label>
            </div>

            <div class="flex gap-3 mt-4">
                <button type="submit"
                        class="bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                    Zapisz zmiany
                </button>

                <a href="{{ route('quizzes.show', $quiz) }}"
                   class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm hover:bg-slate-50">
                    Anuluj
                </a>
            </div>
        </form>
    </div>
@endsection
