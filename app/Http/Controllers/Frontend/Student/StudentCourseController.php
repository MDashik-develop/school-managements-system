<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    // course all
    public function index()
    {
        $courses = Course::where('class', Auth::user()->student->class)
            ->where('status', 'published')
            ->get();
        return view('frontend.student.course.index', compact('courses'));
    }

    //course view
    public function CoursView(Course $course)
    {
        $student = Student::where('user_id', Auth::id())->first();
        $enrolled = $course->enrollments()->where('student_id', $student->id)->exists();
        return view('frontend.student.course.view', compact('course', 'enrolled'));
    }

    //enroll
    public function enroll(Course $course)
    {
        $student = Student::where('user_id', Auth::id())->first();

        try {
            // যদি free course হয়
            if ($course->price <= 0) {
                // পেমেন্ট না থাকলে create
                $student->payments()->firstOrCreate(
                    ['course_id' => $course->id],
                    [
                        'amount_due' => $course->price,
                        'status' => 'paid',
                        'amount_paid' => 0,
                    ]
                );

                // এনরোল না থাকলে create
                Enrollment::firstOrCreate([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }

            return redirect()->route('student.course.view', $course->id);

        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


}
