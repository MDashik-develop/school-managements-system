<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = now();
    
        // Find exams that are happening today and are currently active
        $exams = Exam::where('date','>=', $now->toDateString()) 
                    //  ->where('start_time', '>=', $now->format('H:i'))
                    //  ->where('end_time', '>=', $now->format('H:i'))
                     ->orderBy('date', 'desc')
                     ->get(); 
    
        return view('exams.index', compact('exams'));
    }
    
    public function show(Exam $exam)
    {
        
        $exam->load('mcqQuestions');
        
        return view('backend.mcq_questions.index', compact('exam'));
    }

    /**
     * Show the form for creating a new exam.
     *
     /* @return \Illuminate\Http\Response
    */
    
    public function create()
    {
        // This simply returns the 'Create New Exam' form view you designed
        return view('exams.create');
    }

    /**
     * Store a newly created exam in the database.
    */
    public function store(Request $request)
    {
        // Validate the incoming request data based on your database schema
        $validatedData = $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|in:MCQ,CQ', // Ensures the value is one of the enum options
            'date'       => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'class'      => 'required|string|max:255',
            'section'    => 'nullable|string|max:255',
        ]);

        // Create the new exam record in the database
        $exam = Exam::create($validatedData);

        return redirect()->route('exams.index', ['exam' => $exam->id])
                         ->with('success', 'Exam created successfully. You can now add questions.');
    }
}