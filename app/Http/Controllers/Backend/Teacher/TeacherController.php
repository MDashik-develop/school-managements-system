<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function index()
    {
        return view('backend.teachers.TeacherDashboard');
    }
}