<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Wywołujemy poszczególne seedery w odpowiedniej kolejności
        $this->call([
            AdminSeeder::class,
            EuropeQuizSeeder::class,
            AsiaQuizSeeder::class,
            PolandQuizSeeder::class,
        ]);
    }
}