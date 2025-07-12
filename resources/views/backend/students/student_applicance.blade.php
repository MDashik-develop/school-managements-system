@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 xl:p-8">
    <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
        {{-- Card Header --}}
        <div class="p-4 border-b border-gray-200 sm:p-6 dark:border-gray-700">
            <div class="flex flex-wrap items-center justify-between gap-4">
                {{-- Title and Subtitle --}}
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <i class="mr-2 text-indigo-500 fas fa-user-clock"></i>
                        Pending Student Applicants
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">Review and process new applications</p>
                </div>

                {{-- Search and Count --}}
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                        {{ $students->count() }} Pending
                    </span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="text-gray-400 fas fa-search"></i>
                        </div>
                        <input type="text" class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search...">
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            @if($students->count() > 0)
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Student Information</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Contact</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Application Details</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-400">Status</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($students as $student)
                        <tr class="transition-colors duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-11 w-11">
                                        @if($student->photo)
                                        <img class="object-cover rounded-full h-11 w-11" src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}">
                                        @else
                                        <div class="flex items-center justify-center bg-gray-200 rounded-full h-11 w-11 dark:bg-gray-600">
                                            <i class="text-xl text-gray-400 fas fa-user"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $student->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $student->student_id }} | Class: {{ $student->class }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <div><i class="mr-2 fas fa-phone-alt fa-fw"></i>{{ $student->phone }}</div>
                                <div class="mt-1"><i class="mr-2 fas fa-envelope fa-fw"></i>{{ $student->user->email ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <div><i class="mr-2 fas fa-birthday-cake fa-fw"></i>{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d F, Y') : '-' }}</div>
                                <div class="mt-1"><i class="mr-2 fas fa-calendar-alt fa-fw"></i>Applied: {{ $student->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left">
                                    <button @click="open = !open" class="inline-flex items-center justify-center w-8 h-8 text-gray-400 bg-transparent rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1" role="menu" aria-orientation="vertical">
                                            <form action="{{ route('login') }}" method="POST" class="block">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700" role="menuitem">
                                                    <i class="w-5 h-5 mr-2 text-green-500 fas fa-check-circle"></i>Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('login') }}" method="POST" class="block" onsubmit="return confirm('Are you sure?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700" role="menuitem">
                                                    <i class="w-5 h-5 mr-2 text-red-500 fas fa-times-circle"></i>Reject
                                                </button>
                                            </form>
                                            <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700" role="menuitem">
                                                <i class="w-5 h-5 mr-2 text-blue-500 fas fa-eye"></i>View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="p-8 text-center sm:p-12">
                    <div class="w-16 h-16 mx-auto text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="mt-4 text-lg font-semibold text-gray-800 dark:text-white">No Pending Applications Found</h4>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">New student applications will appear here once they are submitted.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection