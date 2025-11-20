<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');                 // np. "Stolice Europy – poziom podstawowy"
            $table->text('description')->nullable(); // Opis
            $table->string('topic')->default('stolice'); // stolice / flagi / rzeki…
            $table->string('region')->nullable();    // Europa / świat / Azja…
            $table->string('level')->default('łatwy');   // łatwy / średni / trudny
            $table->boolean('is_published')->default(true); // czy widoczny w aplikacji

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
