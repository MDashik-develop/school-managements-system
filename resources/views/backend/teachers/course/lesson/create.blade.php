@extends('layouts.app')

@section('content')
<div class="p-4 max-w-3xl mx-auto bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Add Lesson to: {{ $course->title }}</h2>

    <form method="POST" action="{{ route('lesson.store', $course->id) }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="title">Lesson Title <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-500"
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="content">Content</label>
            <textarea id="content" name="content"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-500"
                      rows="5">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="video_url">Video URL</label>
            <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-500">
            @error('video_url')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="order">Order</label>
            <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-500" min="0">
            @error('order')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-500">
                Save Lesson
            </button>
        </div>
    </form>
</div>
@endsection
