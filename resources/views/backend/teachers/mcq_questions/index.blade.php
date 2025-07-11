@extends('layouts.app')

@section('title', 'Manage Exam Questions')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Back to List Button --}}
    <div class="mb-6">
        <a href="{{ route('exams.index') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Exam Schedule
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
                            @if ($exam->type == 'CQ')
                                {{  $exam->cqQuestions->count() }} Questions
                            @elseif ($exam->type == 'MCQ')
                                {{  $exam->mcqQuestions->count() }} Questions
                            @endif
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
                    <a href="{{ route('mcq_questions.create', ['exam' => $exam->id]) }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Add New Question
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Questions List --}}
    <div class="space-y-6">
        @if ($exam->type === 'MCQ')
            @forelse($exam->mcqQuestions as $index => $question)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all hover:shadow-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">
                            Q{{ $index + 1 }}: {!! $question->question !!}
                            </p>
                            <div class="flex items-center space-x-3 flex-shrink-0 ml-4">
                                {{-- <a href="{{ route('mcq_questions.edit', $question->id) }}" class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-200" title="Edit Question">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a> --}}
                                <form action="{{ route('mcq_questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-300" title="Delete Question">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach(['a', 'b', 'c', 'd'] as $optionKey)
                                @php
                                    $optionText = $question->{'option_' . $optionKey};
                                    $isCorrect = ($question->correct_option == $optionKey);
                                @endphp
                                <div class="flex items-center">
                                    @if($isCorrect)
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <div class="h-5 w-5 mr-2 flex-shrink-0"></div>
                                    @endif
                                    <span class="text-sm text-gray-700 dark:text-gray-300 {{ $isCorrect ? 'font-bold' : '' }}">
                                        {{ strtoupper($optionKey) }}) {{ $optionText }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No Questions Yet</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This exam doesn't have any questions. Get started by adding one.</p>
                        <a href="{{ route('mcq_questions.create', ['exam' => $exam->id]) }}" class="mt-4 inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700">
                            Add First Question
                        </a>
                    </div>
                </div>
            @endforelse
        @elseif ($exam->type === 'CQ')
            @forelse($exam->cqQuestions as $index => $question)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all hover:shadow-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-center gap-2">
                            @if (!empty($question->attachment))
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/' . $question->attachment) }}" alt="{{ $question->question_text }}" class="h-16 w-16 rounded-full object-cover">
                                </div>
                            @endif
                            <p class="text-lg font-semibold text-gray-800 text-start dark:text-white">
                            Q{{ $index + 1 }}: 
                            </p>
                            <div class="flex-1 text-lg font-semibold text-gray-800 text-start dark:text-white">{!! $question->question_text !!}</div>
                            <div class="flex items-center space-x-3 flex-shrink-0 ml-4">
                                {{-- <a href="{{ route('mcq_questions.edit', $question->id) }}" class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-200" title="Edit Question">                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a> --}}
                                <form action="{{ route('cq_questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-300" title="Delete Question">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No Questions Yet</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This exam doesn't have any questions. Get started by adding one.</p>
                            <a href="{{ route('cq_questions.create', ['exam' => $exam->id]) }}" class="mt-4 inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700">
                                Add First Question
                            </a>
                        </div>
                    </div>
            @endforelse
        @endif
    </div>
</div>
@endsection
