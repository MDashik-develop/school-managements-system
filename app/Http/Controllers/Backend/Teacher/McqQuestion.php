<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\McqQuestion as ModelsMcqQuestion;
use Illuminate\Http\Request;

class McqQuestion extends Controller
{
    //
    public function index(Exam $exam)
    {
        if ($exam->type === 'MCQ')
        {
            $exam->load('mcqQuestions');
        }
        elseif ($exam->type === 'CQ')
        {
            $exam->load('cqQuestions');
            // dd($exam->cqQuestions);
        }
        
    
        // Pass the single $exam object (which contains its questions) to the view
        return view('backend.teachers.mcq_questions.index', compact('exam'));
    }
    
    public function create(Exam $exam)
    {
        // Directly check the 'type' property of the $exam object
        if ($exam->type === 'MCQ') 
        {
            // If the type is 'MCQ', show the MCQ creation view
            return view('backend.teachers.mcq_questions.create', compact('exam'));
        } 
        else 
        {
            // Otherwise, show the CQ creation view
            return view('backend.teachers.cq_questions.create', compact('exam'));
        }

    }
    
    public function store(Request $request)
    {
        // Step 1: Validate the data from the form.
        // The keys here (e.g., 'exam_id', 'question') must match the 'name'
        // attributes in your HTML form.
        $validatedData = $request->validate([
            'exam_id'        => 'required|exists:exams,id',
            'question'       => 'required|string',
            'option_a'       => 'required|string|max:255',
            'option_b'       => 'required|string|max:255',
            'option_c'       => 'required|string|max:255',
            'option_d'       => 'required|string|max:255',
            'correct_option' => 'required|in:a,b,c,d',
        ]);

        // Step 2: Create the question in the database using the validated data.
        ModelsMcqQuestion::create($validatedData);

        return redirect()->route('mcq_questions.index', ['exam' => $request->exam_id])
                         ->with('success', 'Question added successfully!');
    }

    public function destroy(ModelsMcqQuestion $question)
    {
        $examId = $question->exam_id;
        
        $question->delete();

        // return redirect()->route('exams.index')->with('success', 'Student deleted successfully.');

        return redirect()->route('exams.index', ['exam' => $examId])
                         ->with('success', 'Question has been deleted successfully!');
    }
}