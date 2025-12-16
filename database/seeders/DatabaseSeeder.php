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
        // Konto Administratora
        User::create([
            'name' => 'Nauczyciel',
            'email' => 'admin@admin.pl',
            'password' => Hash::make('haslo123'),
            'is_admin' => true,
        ]);

        
        // QUIZ 1: Stolice Europy
        
        $europe = Quiz::create([
            'title' => 'Stolice Europy', 
            'description' => 'Sprawdź, czy znasz stolice naszych sąsiadów i nie tylko.'
        ]);

        $europe->questions()->createMany([
            [
                'content' => 'Stolicą Niemiec jest...',
                'option_a' => 'Monachium', 'option_b' => 'Berlin', 'option_c' => 'Hamburg', 'option_d' => 'Kolonia',
                'correct' => 'b'
            ],
            [
                'content' => 'Stolicą Czech jest...',
                'option_a' => 'Praga', 'option_b' => 'Brno', 'option_c' => 'Ostrawa', 'option_d' => 'Pilzno',
                'correct' => 'a'
            ],
            [
                'content' => 'Stolicą Hiszpanii jest...',
                'option_a' => 'Barcelona', 'option_b' => 'Sewilla', 'option_c' => 'Madryt', 'option_d' => 'Walencja',
                'correct' => 'c'
            ],
            [
                'content' => 'Stolicą Francji jest...',
                'option_a' => 'Lyon', 'option_b' => 'Marsylia', 'option_c' => 'Nicea', 'option_d' => 'Paryż',
                'correct' => 'd'
            ]
        ]);

        
        // QUIZ 2: Stolice Azji
        
        $asia = Quiz::create([
            'title' => 'Egzotyczna Azja', 
            'description' => 'Czy rozpoznasz stolice największych azjatyckich krajów?'
        ]);

        $asia->questions()->createMany([
            [
                'content' => 'Stolicą Japonii jest...',
                'option_a' => 'Kioto', 'option_b' => 'Osaka', 'option_c' => 'Tokio', 'option_d' => 'Hiroszima',
                'correct' => 'c'
            ],
            [
                'content' => 'Stolicą Chin jest...',
                'option_a' => 'Szanghaj', 'option_b' => 'Pekin', 'option_c' => 'Hongkong', 'option_d' => 'Shenzhen',
                'correct' => 'b'
            ],
            [
                'content' => 'Stolicą Tajlandii jest...',
                'option_a' => 'Bangkok', 'option_b' => 'Phuket', 'option_c' => 'Pattaya', 'option_d' => 'Chiang Mai',
                'correct' => 'a'
            ],
            [
                'content' => 'Stolicą Indii jest...',
                'option_a' => 'Mumbaj', 'option_b' => 'Kalkuta', 'option_c' => 'Nowe Delhi', 'option_d' => 'Bangalore',
                'correct' => 'c'
            ]
        ]);

         
        // QUIZ 3: Polska: Miasta Wojewódzkie
        
        $poland = Quiz::create([
            'title' => 'Polska: Miasta Wojewódzkie', 
            'description' => 'Test wiedzy lokalnej. Dopasuj miasto do województwa.'
        ]);

        $poland->questions()->createMany([
            [
                'content' => 'Stolicą województwa dolnośląskiego jest...',
                'option_a' => 'Opole', 'option_b' => 'Wrocław', 'option_c' => 'Poznań', 'option_d' => 'Zielona Góra',
                'correct' => 'b'
            ],
            [
                'content' => 'Stolicą województwa podkarpackiego jest...',
                'option_a' => 'Rzeszów', 'option_b' => 'Lublin', 'option_c' => 'Kielce', 'option_d' => 'Kraków',
                'correct' => 'a'
            ],
            [
                'content' => 'Stolicą województwa pomorskiego jest...',
                'option_a' => 'Gdynia', 'option_b' => 'Szczecin', 'option_c' => 'Gdańsk', 'option_d' => 'Sopot',
                'correct' => 'c'
            ],
            [
                'content' => 'Stolicą województwa małopolskiego jest...',
                'option_a' => 'Zakopane', 'option_b' => 'Katowice', 'option_c' => 'Wieliczka', 'option_d' => 'Kraków',
                'correct' => 'd'
            ]
        ]);
    }
}