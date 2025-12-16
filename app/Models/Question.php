<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{
    // Definiujemy pola, które można wypełnić z formularza
    protected $fillable = ['quiz_id', 'content', 'option_a', 'option_b', 'option_c', 'option_d', 'correct'];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
}