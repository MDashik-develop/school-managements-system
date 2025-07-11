<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\McqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentExam extends Controller
{
    //
    public function index()
    {
        $now = now();
        
        $exams = Exam::where('date','>=', $now->toDateString()) 
        //  ->where('start_time', '>=', $now->format('H:i'))
        //  ->where('end_time', '>=', $now->format('H:i'))
         ->orderBy('date', 'desc')
         ->get();
        return view('frontend.student.exams.index' , compact('exams'));
    }
    
    public function create(Exam $exam)
    {
        if($exam->type == 'MCQ'){
            
            $question = $exam->mcqQuestions()->first();
            return view('frontend.student.exams.mcq_create', compact('exam', 'question'));
        }
        if ($exam->type == 'CQ'){     
            $question = $exam->cqQuestions()->first(); // ✅ ঠিক করা
            return view('frontend.student.exams.cq_create', compact('exam', 'question'));
        }
        
    }

    public function submitAnswerMCQ(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:mcq_questions,id',
            'selected_option' => 'required|in:a,b,c,d',
        ]);

        $examAnswrs = McqQuestion::where('exam_id', $exam->id)
            ->where('id', $validated['question_id'])
            ->first();

        $examAnswrs = $examAnswrs->correct_option;

        
        if ($examAnswrs == $validated['selected_option'])
        {
            // $examScores->score = $examScores->score + 1;
            
            $submission = ExamResult::create([
                'student_id' => auth()->user()->student->id,
                'exam_id' => $exam->id,
                'score' => 1,
                'answers' => $validated['selected_option'],
                'question_id' => $validated['question_id'],
            ]);
        }
        else
        {        
            $submission = ExamResult::create([
                'student_id' => auth()->user()->student->id,
                'exam_id' => $exam->id,
                'score' => 0,
                'answers' => $validated,
                'question_id' => $validated['question_id'],
            ]);
        }
        
        
        
        $examScores = ExamResult::where('student_id', auth()->user()->student->id)
            ->where('exam_id', $exam->id)
            ->sum('score');    

        // Get next question
        $nextQuestion = McqQuestion::where('exam_id', $exam->id)
            ->where('id', '>', $validated['question_id'])
            ->orderBy('id')
            ->first();

        if (!$nextQuestion) {
            return response()->json(['status' => 'done',
                            'examScores' => ExamResult::where('student_id', auth()->user()->student->id)
                                ->where('exam_id', $exam->id)
                                ->sum('score'),
                            ]);
        }
                

            
        $html = view('frontend.student.exams._question_card', ['question' => $nextQuestion, 'examScores' => $examScores])->render();

        return response()->json([
            'status' => 'next',
            'html' => $html,
            'examScores' => $examScores,
        ]);
    }

    public function submitAnswerCQ(Request $request, Exam $exam)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_text' => 'nullable|string',
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);
    
        // Get the authenticated student's ID from the 'students' table
        $studentId = auth()->user()->student->id;
    
        // Check if an answer already exists for this student, exam, and question.
        // firstOrNew() will find the existing record or create a new model instance
        // without saving it to the database yet.
        $examResult = ExamResult::firstOrNew([
            'student_id'  => $studentId,
            'exam_id'     => $exam->id,
            'question_id' => $request->question_id,
        ]);
    
        // Only save a new record if it doesn't already exist in the database.
        // The 'exists' property is false for new models retrieved with firstOrNew().
        if (!$examResult->exists) {
            $filePath = null;
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                // Using student_id and question_id for a more unique filename
                $filename = time() . '_student_' . $studentId . '_question_' . $request->question_id . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('answers', $filename, 'public');
            }
    
            // Fill the model with data and save it
            $examResult->fill([
                'attachment' => $filePath,
                'score'      => null,
                'answers'    => $request->answer_text,
            ]);
            
            $examResult->save();
        }
    
        // The logic to find the next question remains the same.
        // This will execute whether the answer was new or already existed.
        $nextQuestion = $exam->questions()->where('id', '>', $request->question_id)->orderBy('id', 'asc')->first();
    
        if ($nextQuestion) {
            return response()->json([
                'status' => 'next',
                'html'   => view('frontend.student.exams._cq_question_card', compact('nextQuestion', 'exam'))->render()
            ]);
        } else {
            return response()->json([
                'status'  => 'done',
                'message' => 'All questions submitted successfully!'
            ]);
        }
    }
    

}