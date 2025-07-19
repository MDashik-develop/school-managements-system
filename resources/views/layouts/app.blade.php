<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif

    <style>
        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            background-color: #f1f5f9;
            /* slate-100 */
        }

        /* Custom scrollbar for a modern look */
        ::-webkit-scrollbar {
            width: 5px;
            height: 3px;
        }

        ::-webkit-scrollbar-track {
            background: #ffffff0c;
            /* slate-50 */
        }

        ::-webkit-scrollbar-thumb {
            background: #ffffff1f;
            /* slate-400 */
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
            /* slate-500 */
        }

        /* Style for the active sidebar link */
        .sidebar-link.active {
            background-color: #4f46e5;
            /* indigo-600 */
            color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        /* Transition for sidebar */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }

        /* Submenu specific styles */
        .submenu-container {
            overflow: hidden;
            transition: max-height 0.7s ease-in-out;
            transition: display 0.10s ease-in-out;
        }

        .submenu-container.collapsed {
            max-height: 0;
            display: none;
        }

        .submenu-container.expanded {
            /* max-height: 200px; Adjust based on content */
            max-height: max-content;
            /* Adjust based on content */
            display: block;
        }

        .sidebar-link .arrow-icon {
            transition: transform 0.3s ease-in-out;
        }

        /* Arrow rotates when the parent .sidebar-link has the 'active' class */
        .sidebar-link.active .arrow-icon {
            transform: rotate(90deg);
        }
    </style>
</head>

<body class="flex h-screen bg-slate-100">

    {{-- Global Success/Error Messages (placed at top of content area) --}}
    <div class="fixed z-50 w-full top-4">
        @if (session('success'))
        <div class="relative max-w-4xl px-4 py-3 mx-auto mb-4 text-green-700 bg-green-100 border border-green-400 rounded"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
        @if ($errors->any())
        <div class="relative max-w-4xl px-4 py-3 mx-auto mb-4 text-red-700 bg-red-100 border border-red-400 rounded"
            role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">Please fix the following errors:</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-30 flex flex-col w-64 transform -translate-x-full bg-slate-800 text-slate-100 lg:translate-x-0 lg:relative">
        <div class="flex items-center justify-center h-20 px-4 border-b border-slate-700">

            <img src="{{ asset('storage/website/white Alphainno logo.png') }}" alt="">
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            {{-- Dashboard link --}}
            @php
            // Check if the current route is 'dashboard'
            $isDashboardActive = Request::routeIs('teacher.dashboard');
            @endphp
            <a href="{{ route('teacher.dashboard') }}"
                class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 {{ $isDashboardActive ? 'active' : '' }}">
                <i data-feather="home" class="w-5 h-5 mr-3"></i>
                <span>Dashboard</span>
            </a>

            <a href="#"
                class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700">
                <i data-feather="dollar-sign" class="w-5 h-5 mr-3"></i>
                <span>Expense</span>
            </a>

            <a href="#"
                class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700">
                <i data-feather="message-square" class="w-5 h-5 mr-3"></i>
                <span>Massagese</span>
            </a>

            {{-- Users & Role Management with Submenu --}}
            <div class="relative">
                @php
                // Check if any user-related, permission, or role route is active
                $isUserRoleActive = Request::routeIs('users.*') || Request::routeIs('permission.*') ||
                Request::routeIs('role.*') || Request::routeIs('user.assign.role');
                @endphp
                <a href="#"
                    class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 {{ $isUserRoleActive ? 'active' : '' }}"
                    data-submenu="user-role-submenu">
                    <div class="flex items-center">
                        <i data-feather="users" class="w-5 h-5 mr-3"></i>
                        <span>
                            {{-- ইউজার ও রোল ম্যানেজমেন্ট --}}
                            Role Management
                        </span>
                    </div>
                    <i data-feather="chevron-right" class="w-4 h-4 arrow-icon"></i>
                </a>
                <div id="user-role-submenu"
                    class="submenu-container {{ $isUserRoleActive ? 'expanded' : 'collapsed' }} pl-8 pt-1 pb-1.5 space-y-1">

                    <a href="{{ route('role.list') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('role.list') || Request::routeIs('role.edit') ? 'active' : '' }}">
                        <span>Roles</span>
                    </a>
                    <a href="{{ route('role.create') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('role.create') ? 'active' : '' }}">
                        <span>Create Roles</span>
                    </a>
                    <a href="{{ route('permission.create') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('permission.create') ? 'active' : '' }}">
                        <span>Create Permissions</span>
                    </a>
                    <a href="{{ route('user.assign.role') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('user.assign.role') ? 'active' : '' }}">
                        <span>Assign Roles</span>
                    </a>
                </div>
            </div>

            {{-- exams --}}
            <div class="relative">
                @php
                $isUserRoleActive = Request::routeIs('exams.*') || Request::routeIs('mcq_questions.*') ||
                Request::routeIs('cq_questions.*') || Request::routeIs('exams.answer') ||
                Request::routeIs('exams.answer.questions') || Request::routeIs('exams.answer.questions.show');
                @endphp
                <a href="{{ route('exams.index') }}"
                    class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 {{ $isUserRoleActive ? 'active' : '' }}"
                    data-submenu="exams-submenu">
                    <div class="flex items-center">
                        <i data-feather="users" class="w-5 h-5 mr-3"></i>
                        <span>
                            Exams
                        </span>
                    </div>
                    <i data-feather="chevron-right" class="w-4 h-4 arrow-icon"></i>
                </a>
                <div id="exams-submenu"
                    class="submenu-container {{ $isUserRoleActive ? 'expanded' : 'collapsed' }} pl-8 pt-1 pb-1.5 space-y-1">

                    <a href="{{ route('exams.index') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('exams.index') ? 'active' : '' }}">
                        <span>All Exam</span>
                    </a>
                    <a href="{{ route('exams.create') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('exams.create') ? 'active' : '' }}">
                        <span>Create Exam</span>
                    </a>
                    <a href="{{ route('exams.answer') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('exams.answer') ? 'active' : '' }}">
                        <span>Exam Answers</span>
                    </a>
                </div>
            </div>

            {{-- student --}}
            <div class="relative">
                @php
                // Check if any user-related, permission, or role route is active
                $isUserRoleActive = Request::routeIs('student.*') ;
                @endphp
                <a href="{{ route('student.index') }}"
                    class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 {{ $isUserRoleActive ? 'active' : '' }}"
                    data-submenu="studentCreate-submenu">
                    <div class="flex items-center">
                        <i data-feather="users" class="w-5 h-5 mr-3"></i>
                        <span>
                            Students
                        </span>
                    </div>
                    <i data-feather="chevron-right" class="w-4 h-4 arrow-icon"></i>
                </a>
                <div id="studentCreate-submenu"
                    class="submenu-container {{ $isUserRoleActive ? 'expanded' : 'collapsed' }} pl-8 pt-1 pb-1.5 space-y-1">

                    <a href="{{ route('student.index') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('student.index') ? 'active' : '' }}">
                        <span>All Students</span>
                    </a>
                    <a href="{{ route('student.create') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('student.create') ? 'active' : '' }}">
                        <span>Create Students</span>
                    </a>
                    <a href="{{ route('student.appliciance.index') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('student.applicants') ? 'active' : '' }}">
                        <span>Student Applicants</span>
                    </a>
                </div>
            </div>

            {{-- Course --}}
            <div class="relative">
                @php
                // Check if any course-related route is active
                $isCourseActive = Request::routeIs('course.*') || Request::routeIs('lesson.*');
                @endphp
                <a href="{{ route('course.create') }}"
                    class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 {{ $isCourseActive ? 'active' : '' }}"
                    data-submenu="course-submenu">
                    <div class="flex items-center">
                        <i data-feather="book-open" class="w-5 h-5 mr-3"></i>
                        <span>
                            Course
                        </span>
                    </div>
                    <i data-feather="chevron-right" class="w-4 h-4 arrow-icon"></i>
                </a>
                <div id="course-submenu"
                    class="submenu-container {{ $isCourseActive ? 'expanded' : 'collapsed' }} pl-8 pt-1 pb-1.5 space-y-1">
                    <a href="{{ route('course.index') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('course.index') ? 'active' : '' }}">
                        <span>All Courses</span>
                    </a>
                    <a href="{{ route('course.create') }}"
                        class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 text-sm {{ Request::routeIs('course.create') ? 'active' : '' }}">
                        <span>Create Course</span>
                    </a>
                </div>
            </div>

        </nav>

        <div class="px-4 py-4 border-t border-slate-700">
            <div class="flex items-center">
                <img class="object-cover w-10 h-10 rounded-full" src="https://placehold.co/100x100/6366f1/FFFFFF?text=A"
                    alt="Admin avatar">
                <div class="ml-3">
                    <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-white">
                        {{ Auth::user()->name }}
                    </a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();" class="text-xs text-slate-400 hover:text-white">
                            Log Out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex flex-col flex-1 overflow-hidden">
        <header
            class="flex items-center justify-between h-20 px-4 bg-white border-b lg:justify-end sm:px-6 lg:px-8 border-slate-200">
            <button id="menu-button" class="lg:hidden text-slate-500 hover:text-slate-700 focus:outline-none">
                <i data-feather="menu" class="w-6 h-6"></i>
            </button>
            <div class="flex items-center gap-4">
                <button
                    class="flex items-center gap-2 px-4 py-2 text-white transition-all duration-300 bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i data-feather="plus-circle" class="w-5 h-5"></i>
                    <span>নতুন পোস্ট</span>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                // Feather Icons initialization
                feather.replace();

                // Sidebar toggle script for mobile
                const menuButton = document.getElementById('menu-button');
                const sidebar = document.getElementById('sidebar');

                if (menuButton && sidebar) {
                    menuButton.addEventListener('click', () => {
                        sidebar.classList.toggle('-translate-x-full');
                    });
                }

                // Submenu toggle script
                document.querySelectorAll('.sidebar-link[data-submenu]').forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default link behavior
                        const submenuId = this.dataset.submenu;
                        const submenu = document.getElementById(submenuId);
                        
                        // Close all other expanded submenus and deactivate their parent links
                        document.querySelectorAll('.submenu-container.expanded').forEach(otherSubmenu => {
                            if (otherSubmenu !== submenu) { // Don't close the current one
                                const otherSubmenuParentLink = otherSubmenu.previousElementSibling;
                                otherSubmenu.classList.remove('expanded');
                                otherSubmenu.classList.add('collapsed');
                                
                                // --- IMPORTANT CHANGE HERE ---
                                // Only remove 'active' from other parent links if their submenu's child is NOT active.
                                // This ensures persistent active state for current page's parent menu.
                                const otherHasActiveChild = otherSubmenu.querySelector('.sidebar-link.active');
                                if (otherSubmenuParentLink && !otherHasActiveChild) {
                                    otherSubmenuParentLink.classList.remove('active'); 
                                }
                                // Arrow rotation is handled by CSS via 'active' class
                            }
                        });

                        if (submenu) {
                            // Toggle the clicked submenu's expanded/collapsed state
                            submenu.classList.toggle('collapsed');
                            submenu.classList.toggle('expanded');

                            // Toggle the 'active' class on the parent link.
                            // This class now controls both the highlight and the arrow rotation via CSS.
                            this.classList.toggle('active');
                        }
                    });
                });

                // On page load, ensure parent links for active submenus are marked active and expanded
                document.querySelectorAll('.submenu-container').forEach(submenu => {
                    const parentLink = document.querySelector(`[data-submenu="${submenu.id}"]`);
                    // Check if any child link within this submenu is currently active
                    const hasActiveChild = submenu.querySelector('.sidebar-link.active');

                    if (parentLink) { // Ensure parent link exists
                        if (hasActiveChild) {
                            parentLink.classList.add('active'); // Add 'active' class to parent link
                            submenu.classList.remove('collapsed');
                            submenu.classList.add('expanded');
                            // The arrow icon will rotate automatically because the parentLink now has 'active' class
                        } else {
                            // Ensure parent is not active and submenu is collapsed if no child is active
                            parentLink.classList.remove('active');
                            submenu.classList.remove('expanded');
                            submenu.classList.add('collapsed');
                        }
                    }
                });


                // Chart.js script for visitor statistics
                const ctx = document.getElementById('visitorsChart');
                if (ctx) { // Only initialize chart if the canvas element exists
                    const visitorsChart = new Chart(ctx.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: ['দিন ১', 'দিন ২', 'দিন ৩', 'দিন ৪', 'দিন ৫', 'দিন ৬', 'দিন ৭'],
                            datasets: [{
                                label: 'ভিজিটর',
                                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
                                borderColor: 'rgb(79, 70, 229)', // indigo-600
                                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#e2e8f0' },
                                    ticks: { color: '#64748b' }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { color: '#64748b' }
                                }
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    titleFont: { family: "'Hind Siliguri', sans-serif" },
                                    bodyFont: { family: "'Hind Siliguri', sans-serif" },
                                    padding: 12,
                                    cornerRadius: 8,
                                    boxPadding: 4,
                                    callbacks: {
                                        label: function(context) {
                                            return ` ভিজিটর: ${context.formattedValue}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });

            $(document).ready(function() {
                $('.longText').summernote();
            });
            
    </script>
</body>

</html>