<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'GeoAcademy')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CDN dla prostego, ładnego wyglądu --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">
    {{-- Top navbar --}}
    <nav class="bg-sky-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-bold text-xl tracking-wide">
                GeoAcademy
            </a>

            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}"
                   class="hover:text-sky-200 {{ request()->routeIs('home') ? 'underline' : '' }}">
                    Strona główna
                </a>
                <a href="{{ route('quizzes.index') }}"
                   class="hover:text-sky-200 {{ request()->routeIs('quizzes.*') ? 'underline' : '' }}">
                    Quizy
                </a>
                <a href="{{ route('quizzes.create') }}"
                   class="bg-white text-sky-800 px-3 py-1 rounded-md text-sm font-semibold hover:bg-sky-100">
                    + Dodaj własny quiz
                </a>
            </div>
        </div>
    </nav>

    {{-- Główna zawartość --}}
    <main class="container mx-auto px-4 py-6 flex-1 w-full max-w-5xl">
        {{-- Komunikaty statusu --}}
        @if (session('status'))
            <div class="mb-4 rounded-md bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        {{-- Błędy walidacji --}}
        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <p class="font-semibold mb-2">Wystąpiły błędy w formularzu:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Stopka --}}
    <footer class="bg-sky-900 text-slate-200 text-sm py-3 mt-6">
        <div class="container mx-auto px-4 flex justify-between">
            <span>&copy; {{ date('Y') }} GeoAcademy</span>
            <span class="italic">Trening z geografii – quizy, które możesz tworzyć samodzielnie.</span>
        </div>
    </footer>
</body>
</html>
