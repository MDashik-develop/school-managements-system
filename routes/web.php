<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\Student\StudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::get('/register/student', [StudentController::class, 'registerStudent'])->name('student.register');
Route::post('/register/student/store', [StudentController::class, 'registerStudentStore'])->name('register.student.store');

 

require __DIR__.'/auth.php';
require __DIR__.'/backend.php';