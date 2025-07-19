@extends('layouts.app')

@section('content')
   <div class="p-4">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold">Course: {{ $course->title }}</h2>
        <a href="{{ route('lesson.create', $course->id) }}"
          class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-500">
          + Add Lesson
        </a>
      </div>

      <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full text-sm divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
               <th class="px-4 py-2 text-left">#</th>
               <th class="px-4 py-2 text-left">Lesson Title</th>
               <th class="px-4 py-2 text-left">Content</th>
               <th class="px-4 py-2 text-left">order</th>
               <th class="px-4 py-2 text-left">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @forelse ($lessons as $index => $lesson)
            <tr>
               <td class="px-4 py-2">{{ $index + 1 }}</td>
               <td class="px-4 py-2">{{ $lesson->title }}</td>
               <td class="px-4 py-2">{{ $lesson->content }}</td>
               <td class="px-4 py-2">{{ $lesson->order }}</td>
               <td class="px-4 py-2">
                <form action="{{ route('lesson.delete', $lesson->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this lesson?');">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                </form>
               </td>
            </tr>
          @empty
            <tr>
               <td colspan="4" class="px-4 py-4 text-center text-gray-500">No lessons found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
   </div>
@endsection