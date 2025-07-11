<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    protected $fillable = ['title', 'file_path', 'youtube_link', 'class', 'section'];
}