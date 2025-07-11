<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['student_id', 'amount', 'status', 'payment_method'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}