<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamAnswer extends Controller
{
    //
    public function index()
    {
        $now = now();
    
        // Find exams that are happening today and are currently active
        $exams = Exam::where('date','<=', $now->toDateString()) 
                    //if date is today then check endtime is gone too    
                    //  ->where('end_time', '<=', $now->format('H:i'))
                     ->where('type', '=', 'CQ')
                     ->orderBy('date', 'desc')
                     ->get(); 
    
        return view('backend.teachers.exams.answer', compact('exams'));
    }

    public function AnswerQuestions(Exam $exam)
    {
        // Load the exam with its questions
        $exam->load('cqQuestions');
        
        // Pass the exam object to the view
        return view('backend.teachers.exams.answer_questions', compact('exam'));
    }

    public function AnswerQuestionsShow(Exam $exam, Question $question)
    {
        $answers = ExamResult::where('exam_id', $exam->id)
            ->where('question_id', $question->id)
            ->get();

        // Load the exam with its questions
        $exam->load('cqQuestions');

        // Pass the exam object to the view
        return view('backend.teachers.exams.answer_questions_show', compact('exam', 'question', 'answers'));
    }

    public function giveScore(Question $question, Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'exam_id' => 'required|exists:exams,id',
            'score' => 'required|numeric',
        ]);

        $examResult = ExamResult::where('exam_id', $validated['exam_id'])
            ->where('question_id', $question->id) // Use the $question object
            ->where('student_id', $validated['student_id'])
            ->first();

            
            // dd( $examResult->score);

        if ($examResult) {
            $examResult->score = $validated['score'];

            // dd($examResult);
            $examResult->save();
        }

        if ($examResult) {
            return redirect()->route('exams.answer.questions.show', [
                'exam' => $validated['exam_id'], 
                'question' => $question->id
            ])->with('success', 'Score updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update score.');
        }
    }
}