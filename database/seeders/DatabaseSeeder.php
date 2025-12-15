<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Konto Administratora (Dane do logowania)
        // Login: admin@geo.pl / Hasło: haslo123
        User::create([
            'name' => 'Nauczyciel Geografii',
            'email' => 'admin@geo.pl',
            'password' => Hash::make('haslo123'),
            'is_admin' => true,
        ]);

        // 2. Przykładowy Quiz Geograficzny
        $quiz = Quiz::create([
            'title' => 'Stolice Europy', 
            'description' => 'Sprawdź, czy znasz stolice naszych sąsiadów.'
        ]);

        // Dodajemy pytania w jednej paczce (czysty kod)
        $quiz->questions()->createMany([
            [
                'content' => 'Stolicą Niemiec jest:',
                'option_a' => 'Monachium', 'option_b' => 'Berlin', 'option_c' => 'Hamburg', 'option_d' => 'Kolonia',
                'correct' => 'b'
            ],
            [
                'content' => 'Jaka jest stolica Czech?',
                'option_a' => 'Praga', 'option_b' => 'Brno', 'option_c' => 'Ostrawa', 'option_d' => 'Pilzno',
                'correct' => 'a'
            ]
        ]);
    }
}