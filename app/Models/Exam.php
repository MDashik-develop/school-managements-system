<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'type', 'date', 'start_time', 'end_time', 'class', 'section'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function mcqQuestions(): HasMany
    {
        return $this->hasMany(McqQuestion::class);
    }
    
    public function cqQuestions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}