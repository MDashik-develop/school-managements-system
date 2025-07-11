@extends('layouts.app')

@section('title', 'Add New Question')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            {{-- This header is now dynamic and uses the $exam variable --}}
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Add Question for: <span class="text-indigo-600">{{ $exam->title }}</span></h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Fill out the details below to add a new question to the exam.</p>
        </div>

        {{-- Create MCQ Form Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('mcq_questions.store', ['exam' => $exam->id]) }}" method="POST">
                @csrf

                {{-- ** THE FIX IS HERE ** --}}
                {{-- This hidden input sends the exam_id along with the form --}}
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                <div class="p-6 sm:p-8">
                    {{-- Question Text Field --}}`
                    <div class="mb-6">
                        <label for="question" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question Text</label>
                        <textarea id="question" name="question" rows="4" class="longText h-20 md:h-52 mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('question') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" placeholder="Enter the full question text here..." required>{{ old('question') }}</textarea>
                        
                        @error('question')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Options Fields --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="option_a" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option A</label>
                            <input type="text" id="option_a" name="option_a" value="{{ old('option_a') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('option_a') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('option_a') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="option_b" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option B</label>
                            <input type="text" id="option_b" name="option_b" value="{{ old('option_b') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('option_b') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('option_b') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="option_c" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option C</label>
                            <input type="text" id="option_c" name="option_c" value="{{ old('option_c') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('option_c') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('option_c') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="option_d" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option D</label>
                            <input type="text" id="option_d" name="option_d" value="{{ old('option_d') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('option_d') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" required>
                             @error('option_d') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Correct Option Selection --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correct Answer</label>
                        <fieldset class="mt-2">
                            <legend class="sr-only">Select the correct option</legend>
                            <div class="flex items-center space-x-6">
                                @foreach(['a', 'b', 'c', 'd'] as $option)
                                <div class="flex items-center">
                                    <input id="correct_option_{{ $option }}" name="correct_option" type="radio" value="{{ $option }}" {{ old('correct_option') == $option ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="correct_option_{{ $option }}" class="ml-2 block text-sm text-gray-900 dark:text-gray-200">
                                        Option {{ strtoupper($option) }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                             @error('correct_option')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </fieldset>
                    </div>

                </div>

                {{-- Form Actions Footer --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center space-x-4">
                    {{-- <a href="{{ route('exams.show', $exam->id) }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">Finish & View Exam</a> --}}
                    <button type="submit" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Save and Add Another
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
