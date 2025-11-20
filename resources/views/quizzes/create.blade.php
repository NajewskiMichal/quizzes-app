@extends('layouts.app')

@section('title', 'Dodaj nowy quiz – GeoAcademy')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-sky-800 mb-4">
            Dodaj nowy quiz
        </h1>

        <form action="{{ route('quizzes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">
                    Tytuł quizu *
                </label>
                <input type="text" id="title" name="title"
                       value="{{ old('title') }}"
                       class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">
                    Opis
                </label>
                <textarea id="description" name="description" rows="3"
                          class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label for="topic" class="block text-sm font-semibold text-slate-700 mb-1">
                        Temat *
                    </label>
                    <input type="text" id="topic" name="topic"
                           value="{{ old('topic', 'stolice') }}"
                           class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    <p class="text-xs text-slate-500 mt-1">
                        Np. stolice, flagi, rzeki...
                    </p>
                </div>

                <div>
                    <label for="region" class="block text-sm font-semibold text-slate-700 mb-1">
                        Region
                    </label>
                    <input type="text" id="region" name="region"
                           value="{{ old('region', 'Europa') }}"
                           class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>

                <div>
                    <label for="level" class="block text-sm font-semibold text-slate-700 mb-1">
                        Poziom trudności *
                    </label>
                    <select id="level" name="level"
                            class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                        @foreach(['łatwy','średni','trudny'] as $level)
                            <option value="{{ $level }}" @selected(old('level', 'łatwy') === $level)>
                                {{ ucfirst($level) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_published" name="is_published"
                       value="1" @checked(old('is_published', true))>
                <label for="is_published" class="text-sm text-slate-700">
                    Quiz jest opublikowany (widoczny na liście)
                </label>
            </div>

            <div class="flex gap-3 mt-4">
                <button type="submit"
                        class="bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                    Zapisz quiz
                </button>

                <a href="{{ route('quizzes.index') }}"
                   class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm hover:bg-slate-50">
                    Anuluj
                </a>
            </div>
        </form>
    </div>
@endsection
