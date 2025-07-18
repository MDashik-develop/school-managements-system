@extends('layouts.app')

@section('content')
   <div
      class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
      <div
        class="max-w-4xl w-full bg-white rounded-xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-[1.01]">
        <div class="text-center mb-10">
          <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">Create New Course</h1>
          <p class="text-lg text-gray-600">Fill out the details below to add a new course to your platform.</p>
        </div>

        <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
               <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title <span
                   class="text-red-500">*</span></label>
               <input type="text" name="title" id="title"
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out @error('title') border-red-500 ring-red-500 @enderror"
                 value="{{ old('title') }}" placeholder="e.g., Introduction to Algebra" required>
               @error('title')
               <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
            @enderror
            </div>

            <div>
               <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Course Slug <span
                   class="text-red-500">*</span></label>
               <input type="text" name="slug" id="slug"
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out @error('slug') border-red-500 ring-red-500 @enderror"
                 value="{{ old('slug') }}" placeholder="e.g., introduction-to-algebra" required>
               @error('slug')
               <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
            @enderror
            </div>
          </div>

          <div>
            <label for="class" class="block text-sm font-medium text-gray-700 mb-1">Class (e.g., "Class 6") <span
                 class="text-red-500">*</span></label>
            <input type="text" name="class" id="class"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out @error('class') border-red-500 ring-red-500 @enderror"
               value="{{ old('class') }}" placeholder="e.g., Class 6, 10th Grade, University Level" required>
            @error('class')
            <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
          @enderror
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="5"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out @error('description') border-red-500 ring-red-500 @enderror"
               placeholder="Provide a detailed description of the course content and objectives.">{{ old('description') }}</textarea>
            @error('description')
            <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
          @enderror
          </div>

          <div>
            <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Course Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail"
               class="mt-1 block w-full text-sm text-gray-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded-full file:border-0
                  file:text-sm file:font-semibold
                  file:bg-blue-50 file:text-blue-700
                  hover:file:bg-blue-100 file:cursor-pointer
                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('thumbnail') border-red-500 ring-red-500 @enderror">
            @error('thumbnail')
            <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
          @enderror
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
               <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
               <input type="number" name="price" id="price" step="0.01"
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out @error('price') border-red-500 ring-red-500 @enderror"
                 value="{{ old('price', 0) }}" min="0">
               @error('price')
               <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
            @enderror
            </div>
            <div>
               <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
               <div class="relative mt-1">
                 <select name="status" id="status"
                   class="block appearance-none w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 pr-10 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
                   <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                   <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                 </select>
                 <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                   <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                     <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                   </svg>
                 </div>
               </div>
               @error('status')
               <p class="mt-1 text-red-600 text-xs italic">{{ $message }}</p>
            @enderror
            </div>
          </div>



          <div class="flex items-center justify-end gap-x-4 pt-4">
            <a href="{{ route('course.index') }}"
               class="inline-flex justify-center py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
               Cancel
            </a>
            <button type="submit"
               class="inline-flex justify-center py-2 px-8 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out transform hover:scale-105">
               Create Course
            </button>
          </div>
        </form>
      </div>
   </div>

   {{-- Basic JavaScript for auto-generating slug from title and handling price/free checkbox --}}
   <script>
      document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        // Function to update slug based on title
        titleInput.addEventListener('keyup', function () {
          slugInput.value = titleInput.value
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '') // Remove all non-word chars except spaces and hyphens
            .replace(/[\s_-]+/g, '-') // Replace spaces and multiple hyphens/underscores with a single hyphen
            .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
        });
      });
   </script>
@endsection