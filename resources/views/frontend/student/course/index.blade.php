@extends('layouts.student')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Available Courses</h2>

    @if($courses->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($courses as $course)
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden border hover:shadow-xl transition">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://via.placeholder.com/400x200?text=No+Image' }}" alt="{{ $course->title }}" class="w-full h-40 object-cover">

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $course->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ Str::limit($course->description, 60) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                {{ $course->price > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-700' }}">
                                {{ $course->price > 0 ? '৳ ' . number_format($course->price) : 'Free' }}
                            </span>

                            @php
                                $enrolled = $course->enrollments()->where('user_id', auth()->id())->exists();
                            @endphp

                            @if($enrolled)
                                <a href="{{ route('student.course.view', $course->id) }}" class="text-sm text-blue-600 hover:underline">
                                    View
                                </a>
                            @else
                                <form action="{{ route('student.course.enroll', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sm text-white bg-indigo-600 px-3 py-1 rounded hover:bg-indigo-700">
                                        Enroll
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded">
            <p>No courses available for your class.</p>
        </div>
    @endif
</div>
@endsection
