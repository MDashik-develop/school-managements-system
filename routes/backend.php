<?php

use App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Backend\Teacher\CqQuestion;
use App\Http\Controllers\Backend\Teacher\ExamAnswer;
use App\Http\Controllers\Backend\Teacher\ExamController;
use App\Http\Controllers\Backend\Teacher\McqQuestion;
use App\Http\Controllers\Backend\Permission\PermissionController;
use App\Http\Controllers\Backend\Student\StudentController;
use App\Http\Controllers\Backend\Teacher\TeacherController;
use App\Http\Controllers\Frontend\Student\StudentExam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {

    // Route::middleware(['auth', 'role.access:admin'])->group(...);
    // Route::middleware(['auth', 'role.access:teacher'])->group(...);
    // Route::middleware(['auth', 'role.access:student'])->group(...);v
    Route::get('/dashboard', function () {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login'); // যদি লগ-ইন না করা থাকে
        }
    
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
    
        if ($user->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
        }
    
        if ($user->hasRole('student')) {
            return redirect()->route('student.dashboard');
        }
    
        abort(403, 'Unauthorized');
    })->name('dashboard');
    
    // 🟢 Admin routes
        Route::middleware(['auth', 'role.access:admin'])->group(function () {
            // Dashboard
            Route::get('/admin/dashboard', [Admin::class, 'index'])->name('admin.dashboard');

            // Permission creation
            Route::get('/create-permission', [PermissionController::class, 'createPermission'])->name('permission.create');
            Route::post('/create-permission', [PermissionController::class, 'storePermission'])->name('permission.store');

            // Role management
            Route::get('/roles', [PermissionController::class, 'indexRole'])->name('role.list');
            Route::get('/create-role', [PermissionController::class, 'createRole'])->name('role.create');
            Route::post('/create-role', [PermissionController::class, 'storeRole'])->name('role.store');
            Route::get('/roles/{role}/edit', [PermissionController::class, 'editRole'])->name('role.edit');
            Route::put('/roles/{role}', [PermissionController::class, 'updateRole'])->name('role.update');
            Route::delete('/roles/{role}', [PermissionController::class, 'deleteRole'])->name('role.delete');

            // Assign role to user
            Route::get('/assign-role', [PermissionController::class, 'assignRoleForm'])->name('user.assign.role');
            Route::post('/assign-role', [PermissionController::class, 'assignRole'])->name('user.assign.role.store');             
        });
    
    // 🟢 Teacher routes
        Route::middleware(['auth', 'role.access:teacher'])->group(function () {
            
            Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
            
            //route student create
            Route::get('teacher/students', [StudentController::class, 'index'])->name('student.index');
            Route::get('teacher/student/create', [StudentController::class, 'create'])->name('student.create');
            Route::post('teacher/student/store', [StudentController::class, 'store'])->name('student.store');
            Route::get('teacher/student/show/{student}', [StudentController::class, 'show'])->name('student.show');
            Route::get('teacher/student/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
            Route::put('teacher/student/update/{student}', [StudentController::class, 'update'])->name('student.update');
            Route::delete('teacher/student/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
            
            // Exam management
            Route::get('teacher/exams', [ExamController::class, 'index'])->name('exams.index');
            Route::get('teacher/exams/create', [ExamController::class, 'create'])->name('exams.create');
            Route::post('teacher/exams/store', [ExamController::class, 'store'])->name('exams.store'); 
            
            Route::get('teacher/exams/{exam}/questions', [McqQuestion::class, 'index'])->name('mcq_questions.index');
            Route::get('teacher/exams/{exam}/mcq-questions/create', [McqQuestion::class, 'create'])->name('mcq_questions.create');
            Route::post('teacher/exams/{exam}/mcq-questions/store', [McqQuestion::class, 'store'])->name('mcq_questions.store');
            Route::delete('teacher/exams/mcq-questions/{question}', [McqQuestion::class, 'destroy'])->name('mcq_questions.destroy');

            // Route::get('/exams/{exam}/cq-questions', [CqQuestion::class, 'index'])->name('cq_questions.index');
            Route::get('teacher/exams/{exam}/cq-questions/create', [CqQuestion::class, 'create'])->name('cq_questions.create');
            Route::post('teacher/exams/{exam}/cq-questions/store', [CqQuestion::class, 'store'])->name('cq_questions.store');
            Route::delete('teacher/exams/cq-questions/{question}', [CqQuestion::class, 'destroy'])->name('cq_questions.destroy');

            Route::get('teacher/exams/answers', [ExamAnswer::class, 'index'])->name('exams.answer');
            Route::get('teacher/exams/answers/{exam}', [ExamAnswer::class, 'AnswerQuestions'])->name('exams.answer.questions');
            Route::get('teacher/exams/answersShow/{exam}/{question}', [ExamAnswer::class, 'AnswerQuestionsShow'])->name('exams.answer.questions.show');
            Route::post('teacher/exams/answers/score/{question}', [ExamAnswer::class, 'giveScore'])->name('exams.answer.questions.score');

            //student appliciance
            Route::get('teacher/all-student-appliciance', [StudentController::class, 'allStudentAppliciance'])->name('student.appliciance.index');
            Route::get('teacher/exams/student-appliciance/create', [StudentController::class, 'create'])->name('student.appliciance.create');
            Route::post('teacher/exams/student-appliciance/store', [StudentController::class, 'store'])->name('student.appliciance.store');
            Route::delete('teacher/exams/student-appliciance/{student}', [StudentController::class, 'destroy'])->name('student.appliciance.destroy');
        });
        
    // 🟢 Student routes
        Route::middleware(['auth', 'role.access:student'])->group(function () {
            Route::get('/student/dashboard', [StudentController::class, 'StudentdDshboard'])->name('student.dashboard');
            
            Route::get('/student/exams', [StudentExam::class, 'index'])->name('student.exams');
            Route::get('/student/exams/{exam}', [StudentExam::class, 'create'])->name('student.exams.create');
            Route::post('/student/exams/{exam}/answer/mcq', [StudentExam::class, 'submitAnswerMCQ'])->name('student.exams.submit.mcq');
            Route::post('/student/exams/{exam}/answer/cq', [StudentExam::class, 'submitAnswerCQ'])->name('student.exams.submit.cq');
        });

});