<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'topic',
        'region',
        'level',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Relacja: Quiz ma wiele pytań.
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('position');
    }

    /**
     * Relacja: Quiz ma wiele wyników (historii gier).
     */
    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }

    /**
     * Zwraca klasę koloru CSS  zależnie od poziomu.
        */
    public function getDifficultyColorAttribute(): string
    {
        return match (strtolower($this->level)) {
            'łatwy'  => 'success', // zielony
            'średni' => 'warning', // żółty/pomarańczowy
            'trudny' => 'danger',  // czerwony
            default  => 'primary', // niebieski
        };
    }
}