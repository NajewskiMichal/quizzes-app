<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Sprawdzamy, czy admin już nie istnieje, żeby nie dublować
        if (!User::where('email', 'admin@admin.pl')->exists()) {
            User::create([
                'name' => 'Nauczyciel',
                'email' => 'admin@admin.pl',
                'password' => Hash::make('haslo123'),
                'is_admin' => true,
            ]);
        }
    }
}