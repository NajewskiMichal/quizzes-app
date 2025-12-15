@extends('layout')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Panel Administratora</h2>
    
    @if($errors->any()) 
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">{{ $errors->first() }}</div> 
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold text-gray-600">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" placeholder="admin@geo.pl" required value="{{ old('email') }}">
        </div>
        <div class="mb-6">
            <label class="block mb-1 font-semibold text-gray-600">Hasło</label>
            <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-bold transition">Zaloguj się</button>
    </form>
    <div class="mt-4 text-center text-sm text-gray-500">
        (Dane domyślne: admin@geo.pl / haslo123)
    </div>
</div>
@endsection