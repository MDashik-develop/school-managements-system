<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User; // User মডেল ইম্পোর্ট করুন
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ডাটাবেজ ট্রানজেকশনের জন্য
use Illuminate\Support\Facades\Hash; // পাসওয়ার্ড হ্যাশ করার জন্য
use Illuminate\Support\Facades\Log;
use App\Traits\SmsSender;

class StudentController extends Controller
{
    use SmsSender;
    //
    public function registerStudent()
    {
        return view('frontend.student.create');
    }

    public function registerStudentStore(Request $request)
    {
        
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'class'   => 'required|string|max:100',
            'phone'   => 'required|string|unique:users,phone|max:20',
            'address' => 'nullable|string',
            'dob'     => 'nullable|date',
            'email'   => 'required|string|unique:users,email',
            'guardian_number' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'     => $validatedData['name'],
                'email'    => $validatedData['email'], 
                'phone'    => '88' . ltrim($validatedData['phone'], '0'),
                'password' => Hash::make($validatedData['phone']),
            ]);

            
            $user->assignRole('student');

            
            Student::create([
                'user_id'    => $user->id,
                'student_id' => date('Y') . $user->id,
                'name'       => $validatedData['name'],
                'class'      => $validatedData['class'],
                'phone'      => '88' . ltrim($validatedData['guardian_number'], '0'),
                'address'    => $validatedData['address'],
                'dob'        => $validatedData['dob'],
                'status'      => 'active',
                'guardian_number' => '88' . ltrim($validatedData['phone'], '0'),
                'father_name' => $validatedData['father_name'],
                'mother_name' => $validatedData['mother_name'],
            ]);

            DB::commit();

            

            $this->sendSms(
                '88' . ltrim($validatedData['guardian_number'], '0'),
                'Your child has been registered successfully.'
            );
            

        
            return redirect()->route('login')->with('success', 'Registration successful! Please login with your mail address as password.');

        } catch (\Exception $e) {
            
            DB::rollBack();

            
            Log::error('Student registration failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

}