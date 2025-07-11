@extends('layouts.app')

@section('title', 'Create New Exam')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Schedule a New Exam</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Define the details for the new exam below.</p>
        </div>

        {{-- Create Exam Form Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('exams.store') }}" method="POST">
                @csrf

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Exam Title --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Exam Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('title') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" placeholder="e.g., Mid-Term Physics Test" required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Exam Type --}}
                        <div class="col-span-1">
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Exam Type</label>
                            <select id="type" name="type" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('type') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select a type</option>
                                <option value="MCQ" {{ old('type') == 'MCQ' ? 'selected' : '' }}>MCQ (Multiple Choice)</option>
                                <option value="CQ" {{ old('type') == 'CQ' ? 'selected' : '' }}>CQ (Creative Questions)</option>
                            </select>
                             @error('type')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Exam Date --}}
                        <div class="col-span-1">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" id="date" name="date" value="{{ old('date') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('date') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Start Time --}}
                        <div class="col-span-1">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time</label>
                            <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('start_time') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('start_time')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- End Time --}}
                        <div class="col-span-1">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                            <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('end_time') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('end_time')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Class --}}
                        <div class="col-span-1">
                            <label for="class" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Class</label>
                            <input type="number" id="class" name="class" value="{{ old('class') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('class') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" placeholder="e.g., 10" required>
                            @error('class')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Section --}}
                        <div class="col-span-1">
                            <label for="section" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Section <span class="text-xs text-gray-500">(Optional)</span></label>
                            <input type="text" id="section" name="section" value="{{ old('section') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('section') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" placeholder="e.g., A">
                             @error('section')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Actions Footer --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center space-x-4">
                    <a href="{{ route('exams.index') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">Cancel</a>
                    <button type="submit" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Save and Add Questions
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
