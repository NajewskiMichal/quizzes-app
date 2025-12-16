<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class EuropeQuizSeeder extends Seeder
{
    public function run()
    {
        $quiz = Quiz::create([
            'title' => 'Stolice Europy', 
            'description' => 'Sprawdź, czy znasz stolice naszych sąsiadów i nie tylko.'
        ]);

        $quiz->questions()->createMany([
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
    }
}