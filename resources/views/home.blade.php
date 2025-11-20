@extends('layouts.app')

@section('title', 'GeoAcademy – trening z geografii')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-4 text-sky-800">
            GeoAcademy – trening z geografii
        </h1>

        <p class="mb-4 text-slate-700 leading-relaxed">
            GeoAcademy to aplikacja webowa do nauki geografii świata.
            Zacznij od quizów ze stolicami państw, a potem rozbuduj bazę
            o własne zestawy pytań – dla szkoły, znajomych albo na powtórkę przed maturą.
        </p>

        <ul class="list-disc list-inside mb-4 text-slate-700">
            <li>gotowe quizy z geografii (stolice),</li>
            <li>możliwość tworzenia własnych quizów,</li>
            <li>pytania typu ABCD z automatyczną oceną wyniku.</li>
        </ul>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('quizzes.index') }}"
               class="inline-block bg-sky-700 text-white px-5 py-2 rounded-md font-semibold hover:bg-sky-800">
                Przejdź do listy quizów
            </a>

            <a href="{{ route('quizzes.create') }}"
               class="inline-block bg-white border border-sky-700 text-sky-800 px-5 py-2 rounded-md font-semibold hover:bg-sky-50">
                Utwórz własny quiz
            </a>
        </div>
    </div>
@endsection
