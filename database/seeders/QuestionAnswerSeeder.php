<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Stolice Europy – poziom podstawowy
        $europeBasic = Quiz::where('title', 'Stolice Europy – poziom podstawowy')->first();

        if ($europeBasic) {
            $questions = [
                [
                    'text' => 'Stolicą Polski jest...',
                    'answers' => [
                        ['text' => 'Warszawa', 'is_correct' => true],
                        ['text' => 'Kraków', 'is_correct' => false],
                        ['text' => 'Gdańsk', 'is_correct' => false],
                        ['text' => 'Poznań', 'is_correct' => false],
                    ],
                ],
                [
                    'text' => 'Stolicą Francji jest...',
                    'answers' => [
                        ['text' => 'Marsylia', 'is_correct' => false],
                        ['text' => 'Paryż', 'is_correct' => true],
                        ['text' => 'Lyon', 'is_correct' => false],
                        ['text' => 'Nicea', 'is_correct' => false],
                    ],
                ],
                [
                    'text' => 'Stolicą Niemiec jest...',
                    'answers' => [
                        ['text' => 'Berlin', 'is_correct' => true],
                        ['text' => 'Monachium', 'is_correct' => false],
                        ['text' => 'Hamburg', 'is_correct' => false],
                        ['text' => 'Frankfurt nad Menem', 'is_correct' => false],
                    ],
                ],
            ];

            $this->createQuestionsForQuiz($europeBasic, $questions);
        }

        // Stolice świata – poziom rozszerzony
        $worldAdvanced = Quiz::where('title', 'Stolice świata – poziom rozszerzony')->first();

        if ($worldAdvanced) {
            $questions = [
                [
                    'text' => 'Stolicą Australii jest...',
                    'answers' => [
                        ['text' => 'Sydney', 'is_correct' => false],
                        ['text' => 'Melbourne', 'is_correct' => false],
                        ['text' => 'Canberra', 'is_correct' => true],
                        ['text' => 'Perth', 'is_correct' => false],
                    ],
                ],
                [
                    'text' => 'Stolicą Kanady jest...',
                    'answers' => [
                        ['text' => 'Toronto', 'is_correct' => false],
                        ['text' => 'Ottawa', 'is_correct' => true],
                        ['text' => 'Vancouver', 'is_correct' => false],
                        ['text' => 'Montreal', 'is_correct' => false],
                    ],
                ],
                [
                    'text' => 'Stolicą Brazylii jest...',
                    'answers' => [
                        ['text' => 'Rio de Janeiro', 'is_correct' => false],
                        ['text' => 'Brasília', 'is_correct' => true],
                        ['text' => 'São Paulo', 'is_correct' => false],
                        ['text' => 'Salvador', 'is_correct' => false],
                    ],
                ],
            ];

            $this->createQuestionsForQuiz($worldAdvanced, $questions);
        }

        // Stolice w Azji
        $asia = Quiz::where('title', 'Stolice w Azji')->first();

        if ($asia) {
            $questions = [
                [
                    'text' => 'Stolicą Japonii jest...',
                    'answers' => [
                        ['text' => 'Osaka', 'is_correct' => false],
                        ['text' => 'Kioto', 'is_correct' => false],
                        ['text' => 'Tokio', 'is_correct' => true],
                        ['text' => 'Hiroshima', 'is_correct' => false],
                    ],
                ],
                [
                    'text' => 'Stolicą Chin jest...',
                    'answers' => [
                        ['text' => 'Szanghaj', 'is_correct' => false],
                        ['text' => 'Pekin', 'is_correct' => true],
                        ['text' => 'Kanton', 'is_correct' => false],
                        ['text' => 'Shenzhen', 'is_correct' => false],
                    ],
                ],
                [
                    'text' => 'Stolicą Indii jest...',
                    'answers' => [
                        ['text' => 'Nowe Delhi', 'is_correct' => true],
                        ['text' => 'Bombaj', 'is_correct' => false],
                        ['text' => 'Kalkuta', 'is_correct' => false],
                        ['text' => 'Bangalore', 'is_correct' => false],
                    ],
                ],
            ];

            $this->createQuestionsForQuiz($asia, $questions);
        }
    }

    /**
     * Helper to create questions + answers for a quiz.
     */
    protected function createQuestionsForQuiz(Quiz $quiz, array $questions): void
    {
        $position = 1;

        foreach ($questions as $qData) {
            $question = Question::create([
                'quiz_id'  => $quiz->id,
                'text'     => $qData['text'],
                'position' => $position++,
            ]);

            foreach ($qData['answers'] as $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'text'        => $answerData['text'],
                    'is_correct'  => $answerData['is_correct'],
                ]);
            }
        }
    }
}
