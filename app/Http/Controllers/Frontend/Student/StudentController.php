<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User; // User মডেল ইম্পোর্ট করুন
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ডাটাবেজ ট্রানজেকশনের জন্য
use Illuminate\Support\Facades\Hash; // পাসওয়ার্ড হ্যাশ করার জন্য
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    //
    public function registerStudent()
    {
        return view('frontend.student.create');
    }

    public function registerStudentStore(Request $request)
    {
        // ধাপ ১: ফর্মের ডেটা ভ্যালিডেট করুন
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'class'   => 'required|string|max:100',
            'phone'   => 'required|string|unique:users,phone|max:20', // users টেবিলে ফোন নম্বর ইউনিক হতে হবে
            'address' => 'nullable|string',
            'dob'     => 'nullable|date',
            'email'   => 'required|string|unique:users,email', // users টেবিলে ইমেইল নম্বর ইউনিক হতে হবে
        ]);

        // ডাটাবেজ ট্রানজেকশন শুরু করুন
        // এর ফলে কোনো একটি ধাপে সমস্যা হলে সব পরিবর্তন বাতিল হয়ে যাবে
        DB::beginTransaction();

        try {
            // ধাপ ২: users টেবিলে নতুন ইউজার তৈরি করুন
            // এখানে আমরা ফোন নম্বরকেই ডিফল্ট পাসওয়ার্ড এবং ইমেইলের অংশ হিসেবে ব্যবহার করছি
            $user = User::create([
                'name'     => $validatedData['name'],
                'email'    => $validatedData['email'], // একটি ইউনিক ইমেইল তৈরি করা হলো
                // 'phone'    => $validatedData['phone'],
                'password' => Hash::make($validatedData['phone']), // ফোন নম্বরকেই ডিফল্ট পাসওয়ার্ড বানানো হলো
            ]);

            // ধাপ ৩: নতুন ইউজারকে 'student' রোল দিন
            $user->assignRole('student');

            // ধাপ ৫: students টেবিলে নতুন ছাত্রের তথ্য তৈরি করুন
            Student::create([
                'user_id'    => $user->id, // নতুন তৈরি হওয়া ইউজারের আইডি
                'student_id' => date('Y') . $user->id, // একটি ইউনিক স্টুডেন্ট আইডি তৈরি করা হলো
                'name'       => $validatedData['name'],
                'class'      => $validatedData['class'],
                'phone'      => $validatedData['phone'],
                'address'    => $validatedData['address'],
                'dob'        => $validatedData['dob'],
            ]);

            // সব ঠিক থাকলে ট্রানজেকশন কমিট করুন
            DB::commit();

            // সফলভাবে রেজিস্ট্রেশন হলে লগইন পেজে পাঠান
            return redirect()->route('login')->with('success', 'Registration successful! Please login with your phone number as password.');

        } catch (\Exception $e) {
            // কোনো সমস্যা হলে ট্রানজেকশন বাতিল করুন
            DB::rollBack();

            // এরর লগ করুন এবং ব্যবহারকারীকে একটি বার্তা দেখান
            Log::error('Student registration failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }
}