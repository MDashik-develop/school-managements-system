@extends('layouts.app')

@section('title', 'Manage Exam Questions')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Back to List Button --}}
    <div class="mb-6">
        <a href="{{ route('exams.answer') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Exam Answers
        </a>
    </div>

    {{-- Exam Details Header Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-end gap-1">
                        {{ $exam->title }}
                        <small class="h-min text-[15px] text-gray-600 font-normal dark:text-gray-300">
                           {{  $exam->cqQuestions->count() }} Questions
                        </small>
                     </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mt-1">
                        Class: {{ $exam->class }}{{ $exam->section ? ' (' . $exam->section . ')' : '' }} | Type: {{ $exam->type }}
                    </p>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ \Carbon\Carbon::parse($exam->date)->format('l, F jS, Y') }}</span>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex-shrink-0">
                    {{-- <a href="{{ route('mcq_questions.create', ['exam' => $exam->id]) }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Add New Question
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Questions List --}}
    <div class="space-y-6">
        @if ($exam->type === 'CQ')
            @forelse($exam->cqQuestions as $index => $question)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all hover:shadow-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-center gap-2">
                            @if (!empty($question->attachment))
                                <a href="{{ route('exams.answer.questions.show', [$question->exam_id, $question->id]) }}" class="flex-shrink-0">
                                    <img src="{{ asset('storage/' . $question->attachment) }}" alt="{{ $question->question_text }}" class="h-16 w-16 rounded-full object-cover">
                                </a>
                            @endif
                            {{-- <p class="text-lg font-semibold text-gray-800 text-start dark:text-white">
                            Q{{ $index + 1 }}: 
                            </p> --}}
                            <div class="flex-1 text-lg font-semibold text-gray-800 text-start dark:text-white">
                              <a href="{{ route('exams.answer.questions.show', [$question->exam_id, $question->id]) }}">
                                 {!! $question->question_text !!}
                              </a>
                            </div>
                            <div class="flex items-center space-x-3 flex-shrink-0 ml-4">
                                 <a href="{{ route('exams.answer.questions.show', [$question->exam_id, $question->id]) }}" class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-200" title="Edit Question">
                                    <button type="button" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2" title="View Answers">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No Answers Yet</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This exam doesn't have any Answers. Get started by adding one.</p>
                            <p class="mt-4 inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700">
                                Not found any answers
                            </->
                        </div>
                    </div>
            @endforelse
        @endif
    </div>
</div>
@endsection
