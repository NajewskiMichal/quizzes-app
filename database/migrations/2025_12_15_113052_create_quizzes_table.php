<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabela Quizów
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Tabela Pytań
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            // Klucz obcy: cascadeOnDelete oznacza, że usunięcie quizu usuwa jego pytania
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->string('content');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->char('correct', 1); // a, b, c lub d
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('quizzes');
    }
};