@extends('layouts.app')

@section('content')

<div
   class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
   <div
      class="max-w-6xl w-full bg-white rounded-xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-[1.01]">

      <div class="text-center mb-10">
         <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">Courses</h1>
         <p class="text-lg text-gray-600">Manage your courses here.</p>
      </div>

      <div class="overflow-x-auto">
         <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
               <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thumbnail</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Class</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Date</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
               </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
               @foreach ($courses as $course)
               <tr>
                  <td class="px-4 py-3">
                     <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $course->thumbnail) }}" alt="">
                  </td>
                  <td class="px-4 py-3 font-medium text-gray-900">{{ $course->title }}</td>
                  <td class="px-4 py-3 text-gray-700">{{ $course->class }}</td>
                  <td class="px-4 py-3 text-gray-600">{{ $course->description }}</td>
                  <td class="px-4 py-3 text-gray-600">{{ $course->duration }}</td>
                  <td class="px-4 py-3 text-gray-600">{{ $course->start_date }}</td>
                  <td class="px-4 py-3 text-gray-600">{{ $course->end_date }}</td>
                  <td class="px-4 py-3 text-gray-600">{{ $course->price }}</td>
                  <td class="px-4 py-3">
                     <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                        @if($course->status == 'published')
                              bg-green-100 text-green-800
                        @else {{-- Assuming 'draft' is the other main status --}}
                              bg-red-100 text-red-800
                        @endif">
                        {{ $course->status }}
                     </span>
                  </td>
                  <td class="px-4 py-3">
                     <div class="flex items-center gap-x-2">
                        <a href="{{ route('course.view', $course->id) }}"
                           class="inline-flex items-center gap-x-1 text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                           View
                        </a>
                        <a href="{{ route('course.edit', $course->id) }}"
                           class="inline-flex items-center gap-x-1 text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                           Edit
                        </a>
                        <form action="{{ route('course.delete', $course->id) }}" method="POST"
                           onsubmit="return confirm('Are you sure you want to delete this course?');" class="inline">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                              Delete
                           </button>
                        </form>
                     </div>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection