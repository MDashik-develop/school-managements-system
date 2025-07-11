{{-- The wrapper div with animation classes --}}
<div class="question-card-enter"> 
   <form id="mcq-form" action="{{ route('student.exams.submit.mcq', $question->exam_id) }}" method="POST" class="bg-white shadow-xl rounded-2xl p-8 space-y-6">
       @csrf
       <input type="hidden" name="question_id" value="{{ $question->id }}">

       {{-- Question Header --}}
       <div class="pb-4 border-b border-gray-200">
           {{-- <p class="text-sm font-semibold text-indigo-600">Question {{ $question->id }}</p> --}}
           <h2 class="text-3xl font-bold text-gray-800 mt-2">{!! $question->question !!}</h2>
       </div>

       {{-- Options --}}
       <div class="space-y-4">
           @foreach(['a', 'b', 'c', 'd'] as $opt)
               <div class="option-container">
                   <input type="radio" name="selected_option" value="{{ $opt }}" id="opt_{{ $opt }}" required class="hidden peer">
                   <label for="opt_{{ $opt }}" class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-lg cursor-pointer transition-all duration-300 peer-checked:border-indigo-600 peer-checked:shadow-lg peer-checked:bg-indigo-50 hover:bg-gray-50">
                       <span class="text-lg text-gray-700 font-medium">
                           <span class="font-bold mr-2">{{ strtoupper($opt) }}.</span> {{ $question->{'option_' . $opt} }}
                       </span>
                       {{-- Custom check icon --}}
                       <svg class="w-6 h-6 text-indigo-600 opacity-0 peer-checked:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                   </label>
               </div>
           @endforeach
       </div>

       {{-- Submit Button --}}
       <div class="pt-4">
           <button type="submit" class="w-full bg-indigo-600 text-white font-bold text-lg px-6 py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-300 ease-in-out transform hover:scale-105">
               Nesxt Question
           </button>
       </div>
   </form>
</div>

<style>
   /* Add this small style block here or move it to your main CSS file */
   .option-container input:focus + label {
       box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.4);
       border-color: #4f46e5;
   }
</style>