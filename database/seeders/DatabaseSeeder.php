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
        // 1. Konto Administratora
        User::create([
            'name' => 'Nauczyciel',
            'email' => 'admin@admin.pl',
            'password' => Hash::make('haslo123'), // hashowanie hasła
            'is_admin' => true,
        ]);

        // 2. Przykładowy Quiz
        $quiz = Quiz::create([
            'title' => 'Stolice Europy', 
            'description' => 'Sprawdź, czy znasz stolice naszych sąsiadów.'
        ]);

        // 3. Pytania 
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