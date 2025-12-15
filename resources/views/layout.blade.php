<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Quizy Geograficzne</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-blue-600 text-white p-4 shadow mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">🌍 GeoQuiz</a>
            <div>
                @auth
                    <span class="mr-4">Witaj, Adminie</span>
                    <a href="{{ route('admin.quizzes.index') }}" class="underline mr-4">Panel</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf <button type="submit" class="bg-blue-800 px-3 py-1 rounded hover:bg-blue-900">Wyloguj</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-700 px-3 py-1 rounded hover:bg-blue-800">Zaloguj jako Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 md:p-6">
        @if(session('success')) <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div> @endif
        @if(session('message')) <div class="bg-blue-100 text-blue-700 p-4 rounded mb-4">{{ session('message') }}</div> @endif
        
        @yield('content')
    </div>
</body>
</html>