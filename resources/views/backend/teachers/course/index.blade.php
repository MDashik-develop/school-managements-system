@extends('layouts.app')

@section('content')

   <div
      class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
      <div
        class="max-w-4xl w-full bg-white rounded-xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-[1.01]">

        <div class="text-center mb-10">
          <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">Courses</h1>
          <p class="text-lg text-gray-600">Manage your courses here.</p>
        </div>

        <div class="flex flex-col gap-y-4 mt-4">
          @foreach ($courses as $course)
           <div class="flex flex-col gap-y-4 mt-4">
            <div class="flex items-center justify-between">
               <div class="flex items-center gap-x-4">
                <div class="flex-shrink-0">
                  <img class="h-12 w-12 rounded-full" src="{{ asset('storage/' . $course->thumbnail) }}" alt="">
                </div>

                <div>
                  <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>

                  <div class="text-sm text-gray-500">{{ $course->class }}</div>
                </div>
               </div>

               <div class="flex items-center gap-x-4">
                <a href="{{ route('course.edit', $course->id) }}"
                  class="inline-flex items-center gap-x-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                  Edit
                </a>
                <form action="{{ route('course.delete', $course->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this course?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                   Delete
                  </button>
                </form>

               </div>
            </div>
            <div class="mt-2 text-sm text-gray-600">
               {{ $course->description }} <br>
               <span class="font-medium text-gray-900">Duration:</span> {{ $course->duration }} <br>
               <span class="font-medium text-gray-900">Start Date:</span> {{ $course->start_date }} <br>
               <span class="font-medium text-gray-900">End Date:</span> {{ $course->end_date }} <br>
               <span class="font-medium text-gray-900">Price:</span> {{ $course->price }} <br>
               <span class="font-medium text-gray-900">Status:</span> {{ $course->status ? 'Active' : 'Inactive' }} <br>
            </div>
           </div>
         @endforeach
        </div>
  @endsection