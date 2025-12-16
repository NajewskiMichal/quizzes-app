<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class PolandQuizSeeder extends Seeder
{
    public function run()
    {
        $quiz = Quiz::create([
            'title' => 'Polska: Miasta Wojewódzkie', 
            'description' => 'Test wiedzy lokalnej. Dopasuj miasto do województwa.'
        ]);

        $quiz->questions()->createMany([
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