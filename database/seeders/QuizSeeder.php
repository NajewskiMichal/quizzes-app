<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzes = [
            [
                'title'        => 'Stolice Europy – poziom podstawowy',
                'description'  => 'Sprawdź, czy znasz stolice najważniejszych państw Europy.',
                'level'        => 'łatwy',
                'topic'        => 'stolice',
                'region'       => 'Europa',
                'is_published' => true,
            ],
            [
                'title'        => 'Stolice świata – poziom rozszerzony',
                'description'  => 'Quiz dla ambitnych – stolice mniej oczywistych państw z całego świata.',
                'level'        => 'trudny',
                'topic'        => 'stolice',
                'region'       => 'świat',
                'is_published' => true,
            ],
            [
                'title'        => 'Stolice w Azji',
                'description'  => 'Zweryfikuj swoją wiedzę z zakresu stolic krajów azjatyckich.',
                'level'        => 'średni',
                'topic'        => 'stolice',
                'region'       => 'Azja',
                'is_published' => true,
            ],
        ];

        foreach ($quizzes as $quizData) {
            Quiz::create($quizData);
        }
    }
}
