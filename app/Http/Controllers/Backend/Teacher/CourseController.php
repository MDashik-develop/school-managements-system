<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::all();
        return view('backend.teachers.course.index', compact('courses'));
    }
    public function create()
    {
        $course = new Course();
        return view('backend.teachers.course.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses,slug',
            'class' => 'required|string|max:100',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published',
        ]);

        // Handle the thumbnail upload if exists
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            // Unique filename with timestamp and user_id (creator_id)
            $filename = time() . '_' . auth()->id() . '.' . $file->getClientOriginalExtension();

            // Store in 'public/courses' folder (you may adjust folder name)
            $thumbnailPath = $file->storeAs('courses', $filename, 'public');
        }

        // Create the course record
        $course = Course::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'class' => $validated['class'],
            'description' => $validated['description'] ?? null,
            'thumbnail' => $thumbnailPath,  // saved path or null
            'price' => $validated['[price]'] ?? 0,
            'status' => $validated['status'],
            'creator_id' => Auth::id(), // assuming user is authenticated
        ]);

        // Redirect to course list or show page with success message
        return redirect()->route('course.index')
            ->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
    {
        $course = Course::findOrFail($course->id);
        return view('backend.teachers.course.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published',
        ]);


        // Update course data
        $course->title = $validated['title'];
        $course->class = $validated['class'];
        $course->description = $validated['description'] ?? null;
        $course->price = $validated['price'] ?? 0;
        $course->status = $validated['status'];
        // creator_id should not change on update, so no need to update it

        $course->save();

        return redirect()->route('course.index')->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        // Check and delete thumbnail from storage
        if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('course.index')->with('success', 'Course deleted successfully!');
    }

    // lesson
    public function view(Course $course)
    {
        $lessons = Lesson::where('course_id', $course->id)->get();

        return view('backend.teachers.course.view', compact('course', 'lessons'));
    }

    public function LessonCreate(Course $course)
    {
        $lesson = new Lesson();
        return view('backend.teachers.course.lesson.create', compact('course', 'lesson'));
    }

    public function LessonStore(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['course_id'] = $course->id;

        Lesson::create($validated);

        return redirect()->route('course.view', $course->id)->with('success', 'Lesson created successfully!');
    }

    public function LessonDestroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('course.view', $lesson->course_id)->with('success', 'Lesson deleted successfully!');
    }

}
