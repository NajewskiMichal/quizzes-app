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
     * Questions assigned to this quiz.
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('position');
    }
}
