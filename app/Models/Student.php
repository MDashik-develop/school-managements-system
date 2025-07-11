<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'name', 'class', 'section', 'phone', 'address', 'dob', 'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}