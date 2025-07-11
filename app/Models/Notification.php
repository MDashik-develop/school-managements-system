<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['student_id', 'type', 'message', 'sent'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}