<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'name',
        'class',
        'section',
        'phone',
        'address',
        'dob',
        'photo',
        'status',
        'guardian_number',
        'father_name',
        'mother_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}