<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::where('class', Auth::user()->student->class)
                           ->where('status', 'published')
                           ->get();
        return view('frontend.student.course.index', compact('courses'));
    }
}
