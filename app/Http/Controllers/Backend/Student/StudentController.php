<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Mail\StudentAprove;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function StudentdDshboard()
    {
        return view('backend.students.StudentdDshboard');
    }
    
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('backend.students.index', compact('students'));
    }

    public function create()
    {
        return view('backend.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'class' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'address' => 'nullable|string',
            'password' => 'required|min:6',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // optional photo validation
             
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // default password
        ]);
        
        // $user->assignRole('student');

        

        $filePath = null;
        // 2. Check if an attachment was uploaded
        if ($request->hasFile('photo')) {
            // Get the uploaded file
            $file = $request->file('photo');

            // Create a unique filename with timestamp and exam_id
            $filename = time() . '_' . $user->id. '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('students', $filename, 'public');
        }

        // dd($filePath);
        // Create student profile
        Student::create([
            'user_id' => $user->id,
            'student_id' => strtoupper(Str::random(6)),
            'name' => $request->name,
            'class' => $request->class,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->date_of_birth,
            'photo' => $filePath,
        ]);

        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('backend.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('backend.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string',
            'class' => 'required|string',
            'phone' => 'required',
        ]);

        $student->update([
            'name' => $request->name,
            'class' => $request->class,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $student->user->update([
            'name' => $request->name,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->user()->delete();
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }


    //student appliciance
    public function allStudentAppliciance()
    {
        $students = Student::with('user')->where('status', 'pending')->get();
        return view('backend.students.student_applicance', compact('students'));
    }

    //student appliciance
    public function StudentApproveSendMail(Student $student)
    {
        // dd( $student->user->email);
        $details = [
            'subject' => 'Please complete the procces Alphainno',
            'link' => route('student.aprove.payment', $student->id), 
            'name' => $student->name,
            'class' => $student->class,
            'dob' => $student->dob,
            'student_id' => $student->student_id,
            'user_id' => $student->user_id,
        ];

        Mail::to($student->user->email)->send(new StudentAprove($details));

        return redirect()->route('student.appliciance.index')->with('success', 'Mail sent successfully!.');
    }
}