@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- Back to List Button --}}
        <div class="mb-6">
            <a href="{{ route('student.index') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">
                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Students
            </a>
        </div>

        {{-- Student Profile Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row items-center">
                    
                    {{-- Avatar --}}
                    <div class="flex-shrink-0 mb-6 sm:mb-0 sm:mr-8">
                        <img class="h-32 w-32 rounded-full object-cover shadow-md" src="{{ asset('storage/' . $student->photo) }}" alt="Student Avatar">
                    </div>
                    
                    {{-- Student Name and Class --}}
                    <div class="text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $student->name }}</h1>
                        <p class="text-lg text-indigo-600 dark:text-indigo-400 font-medium">Class: {{ $student->class }}</p>
                        <p class="text-md text-gray-500 dark:text-gray-400 mt-1">Student ID: {{ $student->student_id }}</p>
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-200 dark:border-gray-700"></div>

            {{-- Contact Information Section --}}
            <div class="p-6 sm:p-8">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Phone Number --}}
                    <div class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="h-6 w-6 mr-3 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $student->phone ?? 'Not Provided' }}</span>
                    </div>
                    
                    {{-- Address --}}
                    <div class="flex items-center text-gray-600 dark:text-gray-300">
                        <svg class="h-6 w-6 mr-3 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $student->address ?? 'Not Provided' }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions Footer --}}
            <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <a href="{{ route('student.edit', $student) }}" class="inline-flex items-center bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600 transition-colors duration-300">
                     <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </a>
                <form action="{{ route('student.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection