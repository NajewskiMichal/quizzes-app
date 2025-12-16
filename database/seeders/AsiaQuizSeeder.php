<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class AsiaQuizSeeder extends Seeder
{
    public function run()
    {
        $quiz = Quiz::create([
            'title' => 'Egzotyczna Azja', 
            'description' => 'Czy rozpoznasz stolice największych azjatyckich krajów?'
        ]);

        $quiz->questions()->createMany([
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
    }
}