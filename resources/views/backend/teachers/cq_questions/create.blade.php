@extends('layouts.app')

@section('title', 'Add New Creative Question')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-8">
            {{-- This header is now dynamic and uses the $exam variable --}}
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Add Creative Question for: <span class="text-indigo-600">{{ $exam->title }}</span></h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Fill out the details below to add a new creative question to the exam.</p>
        </div>

        {{-- Create CQ Form Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('cq_questions.store', ['exam' => $exam->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ** THE FIX IS HERE ** --}}
                {{-- This hidden input sends the exam_id along with the form --}}
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                <div class="p-6 sm:p-8">
                    {{-- Question Text Field --}}
                    <div class="mb-6">
                        <label for="question_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question Text</label>
                        <textarea id="question_text" name="question_text" rows="4" class="longText h-20 md:h-52 mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border @error('question_text') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-md shadow-sm" placeholder="Enter the full question text here..." required>{{ old('question_text') }}</textarea>
                        
                        @error('question_text')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Attachment Upload Field --}}
                    <div class="mb-6">
                        <label for="attachment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question Attachment</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md @error('attachment') border-red-500 @enderror">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="attachment" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="attachment" name="attachment" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.pdf">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    JPG, JPEG, PNG, PDF up to 2MB
                                </p>
                            </div>
                        </div>
                        @error('attachment')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Form Actions Footer --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center space-x-4">
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
