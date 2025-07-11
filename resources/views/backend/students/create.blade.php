@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Enroll a New Student</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Fill out the form below to add a new student to the roster.</p>
        </div>

        {{-- Add Student Form Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Name Field --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email (for login)</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('email') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                             @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Class Field --}}
                        <div class="col-span-1">
                            <label for="class" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Class</label>
                            <input type="text" id="class" name="class" value="{{ old('class') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('class') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                             @error('class')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone Field --}}
                        <div class="col-span-1">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('phone') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                             @error('phone')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- password Field --}}
                        <div class="col-span-1">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <input type="password" id="password" name="password" value="{{ old('password') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('password') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                             @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- date_of_birth Field --}}
                        <div class="col-span-1">
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('date_of_birth') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                             @error('dob')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Address Field --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <textarea id="address" name="address" rows="3" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('address') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('address') }}</textarea>
                             @error('address')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- photo Field --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
                            <input type="file" id="photo" name="photo" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('photo') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                             @error('photo')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Actions Footer --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center space-x-4">
                    <a href="{{ route('student.index') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white transition-colors duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
