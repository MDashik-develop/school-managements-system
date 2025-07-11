@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="mb-8 p-6 bg-white rounded-xl shadow-lg border border-gray-200">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Exam: {{ $exam->title ?? 'N/A' }}</h1>
            <p class="mt-2 text-md sm:text-lg text-gray-600">Showing answers for Question: <span
                    class="font-semibold text-gray-800">{!! $question->question_text ?? 'ID: ' . $question->id !!}</span></p>
        </div>

        {{-- Answers List --}}
        <div class="space-y-6">
            @forelse ($answers as $answer)
                {{-- Card background changes if scored --}}
                <div
                    class="rounded-xl shadow-md border border-gray-200 hover:shadow-xl transition-shadow duration-300 ease-in-out overflow-hidden @if (!is_null($answer->score)) bg-gray-200 @else bg-white @endif">
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-indigo-700">
                                    {{ $answer->student->name ?? 'Student' }} : {{ $answer->student->student_id ?? 'N/A' }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">Submitted at:
                                    {{ $answer->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0">
                                @if (!is_null($answer->score))
                                    <span
                                        class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">Score:
                                        {{ $answer->score }}</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">Not
                                        Graded</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 border-t border-gray-200 pt-4">
                            <h4 class="font-semibold text-gray-700 mb-2">Submitted Answer:</h4>
                            <div class="prose prose-sm max-w-none border p-2 rounded-md whitespace-pre-wrap">
                                @if (is_array($answer->answers))
                                    <pre><code>{{ json_encode($answer->answers, JSON_PRETTY_PRINT) }}</code></pre>
                                @else
                                    <p>{!! $answer->answers ?? 'No textual answer provided.' !!}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Attachment Section --}}
                        <div class="mt-6">
                            @if ($answer->attachment)
                                @php
                                    $filePath = asset('storage/' . $answer->attachment);
                                    $isImage = in_array(strtolower(pathinfo($answer->attachment, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'gif', 'webp']);
                                @endphp
                                <h4 class="font-semibold text-gray-700 mb-2">Attachment:</h4>
                                @if ($isImage)
                                    <a href="{{ $filePath }}" class="image-link group" target="_blank">
                                        <img src="{{ $filePath }}" alt="Attachment"
                                            class="max-w-16 h-auto rounded-lg border border-gray-300 group-hover:opacity-80 transition-opacity">
                                    </a>
                                @else
                                    <a href="{{ $filePath }}"
                                        class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 hover:underline"
                                        download>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        {{ basename($answer->attachment) }}
                                    </a>
                                @endif
                            @else
                                <p class="text-gray-500">No attachment submitted.</p>
                            @endif
                        </div>
                        
                        {{-- Scoring Form --}}
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <form action="{{ route('exams.answer.questions.score', ['question' => $question->id]) }}"
                                method="POST" class="flex items-start gap-4">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $answer->student_id }}">
                                <input type="hidden" name="exam_id" value="{{ $answer->exam_id }}">
                                <div class="w-full">
                                    <label for="score-{{ $answer->id }}" class="sr-only">Score</label>
                                    <input type="number" step="any" name="score" id="score-{{ $answer->id }}"
                                        class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 disabled:bg-gray-200 disabled:opacity-70"
                                        placeholder="Enter score..." {{ !is_null($answer->score) ? 'disabled' : '' }}>
                                    @error('score')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="w-48 bg-indigo-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-indigo-700 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
                                    {{ !is_null($answer->score) ? 'disabled' : '' }}>
                                    {{ !is_null($answer->score) ? 'Scored' : 'Give Score' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 px-6 bg-white rounded-xl shadow-md border border-gray-200">
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No Answers Yet</h3>
                    <p class="mt-1 text-sm text-gray-500">There have been no submissions for this question.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Image Modal --}}
    <div id="imageModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-75 z-50 justify-center items-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="Enlarged Attachment" class="w-full h-auto rounded-lg shadow-2xl">
            <button id="closeModal"
                class="absolute -top-4 -right-4 text-white bg-red-600 rounded-full w-10 h-10 flex items-center justify-center hover:bg-red-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const modal = document.getElementById('imageModal');
         const modalImage = document.getElementById('modalImage');
         const closeModalBtn = document.getElementById('closeModal');
         const imageLinks = document.querySelectorAll('a.image-link');

         // Function to open the modal
         const openModal = (e) => {
               e.preventDefault();
               const imageUrl = e.currentTarget.href;
               modalImage.src = imageUrl;
               modal.classList.remove('modal-hidden');
               modal.classList.add('modal-active');
               // Add this line to prevent background scrolling
               document.body.classList.add('overflow-hidden'); 
         };

         // Function to close the modal
         const closeModal = () => {
               modal.classList.add('modal-hidden');
               modal.classList.remove('modal-active');
               modalImage.src = ''; // Clear the src to stop loading
               // Add this line to re-enable background scrolling
               document.body.classList.remove('overflow-hidden');
         };

         // Add click event listeners to all image links
         imageLinks.forEach(link => {
               link.addEventListener('click', openModal);
         });

         // Add click event listener to the close button
         if (closeModalBtn) {
               closeModalBtn.addEventListener('click', closeModal);
         }

         // Add click event listener to the modal background to close it
         if (modal) {
               modal.addEventListener('click', (e) => {
                  if (e.target === modal) {
                     closeModal();
                  }
               });
         }
         
         // Add keydown event listener to close modal with Escape key
         document.addEventListener('keydown', (e) => {
               if (e.key === 'Escape' && modal.classList.contains('modal-active')) {
                  closeModal();
               }
         });
      });
   </script>
   <style>
      html{
         overflow-y: hidden
      }
      .modal-hidden {
         display: none;
      }
      .modal-active {
         display: flex;
      }
   </style>
@endsection
