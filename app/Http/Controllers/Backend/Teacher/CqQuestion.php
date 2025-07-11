<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CqQuestion extends Controller
{
    //
    public function index(Exam $exam)
    {
        $exam->load('cqQuestions');

        return view('backend.teachers.cq_questions.index);', compact('exam'));
    }

    public function create(Exam $exam)
    {
        return view('backend.teachers.cq_questions.create', compact('exam'));
    }

    public function store(Request $request)
    {
        // 1. Validate the form data
        $validatedData = $request->validate([
            'exam_id'       => 'required|exists:exams,id',
            'question_text' => 'required',
            'attachment'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB Max
        ]);

        $filePath = null;
        // 2. Check if an attachment was uploaded
        if ($request->hasFile('attachment')) {
            // Get the uploaded file
            $file = $request->file('attachment');

            // Create a unique filename with timestamp and exam_id
            $filename = time() . '_' . $request->exam_id . '.' . $file->getClientOriginalExtension();
            // Store the file in 'storage/app/public/attachments'
            $filePath = $file->storeAs('attachments', $filename, 'public');
        }

        // 3. Create the question in the database
        Question::create([
            'exam_id'       => $validatedData['exam_id'],
            'question_text' => $validatedData['question_text'],
            'attachment'    => $filePath, // Save the file path to the database
        ]);

        // 4. Redirect back with a success message
        return redirect()->route('mcq_questions.index', ['exam' => $request->exam_id])
            ->with('success', 'Creative Question added successfully!');
    }

    public function destroy(Question $question)
    {
        $examId = $question->exam_id;

        // Delete the physical file if it exists
        if ($question->attachment && Storage::disk('public')->exists($question->attachment)) {
            Storage::disk('public')->delete($question->attachment);
        }

        $question->delete();

        // return redirect()->route('exams.index')->with('success', 'Student deleted successfully.');

        return redirect()->route('mcq_questions.index', ['exam' => $examId])
            ->with('success', 'Question has been deleted successfully!');
    }
}