<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model 
{
    protected $fillable = ['title', 'description'];
    
    // Relacja: Jeden Quiz posiada wiele Pytań
    // Wykorzystywana do kaskadowego usuwania lub pobierania całości
    public function questions() {
        return $this->hasMany(Question::class);
    }
}