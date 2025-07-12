<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Instrument Sans', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Scrollbar for horizontal scroll sections */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="text-gray-900 bg-white">

    <header class="w-full border-b border-gray-200">
        <nav aria-label="Primary Navigation"
            class="flex items-center justify-between px-4 py-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center space-x-6">
                <a class="flex items-center space-x-2" href="#">
                    <img alt="Lernen logo, circular icon with letter L" class="w-8 h-8" height="32"
                        src="https://storage.googleapis.com/a1aa/image/7da0ba9f-dea2-4aa7-825f-6107750a6ab7.jpg"
                        width="32" />
                    <span class="text-xl font-bold text-gray-900 select-none">
                        Lernen
                    </span>
                </a>
                <ul class="hidden space-x-6 text-sm font-normal text-gray-700 md:flex">
                    <li class="relative group">
                        <button aria-expanded="false" aria-haspopup="true"
                            class="flex items-center space-x-1 hover:text-gray-900 focus:outline-none">
                            <span>
                                Home
                            </span>
                            <i class="text-xs fas fa-chevron-down">
                            </i>
                        </button>
                    </li>
                    <li>
                        <a class="hover:text-gray-900" href="#">
                            Find Tutors
                        </a>
                    </li>
                    <li class="relative group">
                        <button aria-expanded="false" aria-haspopup="true"
                            class="flex items-center space-x-1 hover:text-gray-900 focus:outline-none">
                            <span>
                                Courses
                            </span>
                            <i class="text-xs fas fa-chevron-down">
                            </i>
                        </button>
                    </li>
                    <li class="relative group">
                        <button aria-expanded="false" aria-haspopup="true"
                            class="flex items-center space-x-1 hover:text-gray-900 focus:outline-none">
                            <span>
                                Subscriptions
                            </span>
                            <i class="text-xs fas fa-chevron-down">
                            </i>
                        </button>
                    </li>
                    <li class="relative group">
                        <button aria-expanded="false" aria-haspopup="true"
                            class="flex items-center space-x-1 hover:text-gray-900 focus:outline-none">
                            <span>
                                More
                            </span>
                            <i class="text-xs fas fa-chevron-down">
                            </i>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="flex items-center space-x-4 text-sm font-normal text-gray-700">
                {{-- <div class="relative cursor-pointer select-none group">
                    <button class="flex items-center space-x-1 hover:text-gray-900 focus:outline-none">
                        <span>
                            USD $
                        </span>
                        <i class="text-xs fas fa-chevron-down">
                        </i>
                    </button>
                </div> --}}
                {{-- <div class="relative flex items-center space-x-1 cursor-pointer select-none group">
                    <img alt="UK flag" class="object-cover w-4 h-3 rounded-sm" height="15" loading="lazy"
                        src="https://flagcdn.com/w20/gb.png" width="20" />
                    <button class="flex items-center space-x-1 hover:text-gray-900 focus:outline-none">
                        <span>
                            En
                        </span>
                        <i class="text-xs fas fa-chevron-down">
                        </i>
                    </button>
                </div> --}}
                <a href="{{ route('login') }}"
                    class="px-5 py-2 text-sm font-semibold text-white bg-indigo-900 rounded-full hover:bg-indigo-800 focus:outline-none"
                    type="button">
                    Sign in
                </a>
                <a href="{{ route('student.register') }}"on
                    class="px-5 py-2 text-sm font-semibold text-gray-700 border border-gray-700 rounded-full hover:bg-gray-100 focus:outline-none"
                    type="button">
                    Get Started
                </a>
            </div>
        </nav>
    </header>
    <div class="px-4 mx-auto mt-6 mb-12 sm:px-6 lg:px-8">
        <section
            class="relative bg-gradient-to-b from-[#2a2c5a] to-[#3a3f8f] rounded-2xl overflow-hidden p-6 sm:p-10 md:p-14 lg:p-20 flex flex-col md:flex-row items-center md:items-start"
            style="min-height: 420px;">
            <!-- Left content -->
            <div class="z-10 flex-1 max-w-xl text-white">
                <div
                    class="inline-flex items-center space-x-2 mb-4 bg-gradient-to-r from-[#7a6edc] to-[#a18fff] rounded-md px-3 py-1">
                    <div class="flex items-center justify-center w-5 h-5 rounded bg-white/30">
                        <i class="text-xs text-white fas fa-eye">
                        </i>
                    </div>
                    <span class="text-xs font-semibold select-none">
                        Enhance your learning experience
                    </span>
                </div>
                <h1 class="mb-4 text-3xl font-extrabold leading-tight sm:text-4xl md:text-5xl">
                    Enhance Your Learning Experience with
                    <span class="text-green-500">
                        Our Expert
                    </span>
                    <br />
                    Mentor
                </h1>
                <p class="max-w-md mb-8 text-sm text-gray-300 sm:text-base">
                    Achieve your goals with personalized tutoring from top experts.
                    <br />
                    Connect with dedicated tutors for success.
                </p>
                <div class="flex space-x-4">
                    <button
                        class="px-6 py-2 text-sm font-semibold text-gray-900 bg-green-400 rounded-full hover:bg-green-500 sm:text-base"
                        type="button">
                        Explore all tutors
                    </button>
                    <button
                        class="flex items-center px-6 py-2 space-x-2 text-sm font-semibold text-white transition border border-white rounded-full sm:text-base hover:bg-white hover:text-indigo-900"
                        type="button">
                        <i class="text-xs fas fa-play">
                        </i>
                        <span>
                            See demo
                        </span>
                    </button>
                </div>
                <div class="flex items-center max-w-lg space-x-6 mt-14 opacity-40">
                    <img alt="Jira Software logo in white" class="object-contain w-auto h-5" height="20" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/ee18d415-6be7-4c43-384b-8ccc7957639c.jpg"
                        width="80" />
                    <img alt="Dribbble logo in white" class="object-contain w-auto h-5" height="20" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/1743450d-acc3-4193-7202-2f914459976b.jpg"
                        width="80" />
                    <img alt="LiveChat logo in white" class="object-contain w-auto h-5" height="20" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/b6e32c52-5b89-489b-0ffd-c9d6bb9a2a34.jpg"
                        width="80" />
                    <img alt="Dropbox logo in white" class="object-contain w-auto h-5" height="20" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/50cb5ac9-cf78-4f04-32b2-b8efa3038b3a.jpg"
                        width="80" />
                    <img alt="Typeform logo in white" class="object-contain w-auto h-5" height="20" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/7cbb2fe5-b1d7-4f83-94e3-677712fe3566.jpg"
                        width="80" />
                    <img alt="Squarespace logo in white" class="object-contain w-auto h-5" height="20" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/9aa0c539-804f-42bc-4455-6bfd17bce179.jpg"
                        width="80" />
                </div>
            </div>
            <!-- Right images and overlays -->
            <div class="relative flex justify-center flex-1 w-full max-w-lg mt-10 md:mt-0 md:justify-end">
                <!-- Left smaller image with border shape -->
                <div class="absolute top-[1.5rem] left-0 md:left-[150px] w-32 h-40 rounded-lg border border-green-500 border-opacity-30 overflow-hidden"
                    style="clip-path: polygon(0 0, 100% 0, 100% 85%, 85% 100%, 0 100%)">
                    <img alt="Young woman with glasses holding orange folder giving thumbs up, inside a polygon clipped border"
                        class="object-cover w-full h-full" height="160" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/589478a0-548f-4c63-97cf-102e46c4a732.jpg"
                        width="128" />
                </div>
                <!-- Center bigger image with polygon shape -->
                <div class="relative w-48 h-56 ml-24 overflow-hidden rounded-lg"
                    style="clip-path: polygon(0 0, 100% 0, 100% 85%, 85% 100%, 0 100%)">
                    <img alt="Man with glasses and arms crossed, purple background, polygon clipped shape"
                        class="object-cover w-full h-full" height="224" loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/8ffa3c15-0616-43b9-b9fb-83e39d7b870d.jpg"
                        width="192" />
                    <button aria-label="Play video"
                        class="absolute flex items-center justify-center text-white transition bg-white rounded-full top-3 right-3 w-9 h-9 bg-opacity-30 hover:bg-opacity-50">
                        <i class="text-sm fas fa-play">
                        </i>
                    </button>
                </div>
                <!-- Top right circular graph icon with green badge -->
                <div class="absolute flex flex-col items-center space-y-1 top-6 right-12">
                    <div class="flex items-center justify-center bg-white rounded-full w-14 h-14">
                        <img alt="Circular icon with purple vertical bar graph" class="object-contain w-7 h-7"
                            height="28" loading="lazy"
                            src="https://storage.googleapis.com/a1aa/image/5f2bbcbd-eb5f-45ea-6141-2a235b009cd9.jpg"
                            width="28" />
                    </div>
                    <div class="px-2 -mt-2 text-xs font-semibold text-gray-900 bg-green-400 rounded-full select-none"
                        style="min-width: 24px;">
                        5+
                    </div>
                </div>
                <!-- Middle bottom white info box with bar chart and text -->
                <div
                    class="absolute bottom-[-12%] left-5 flex items-center space-x-3 bg-white rounded-full px-5 py-2 shadow-md max-w-xs">
                    <img alt="Bar chart icon with colorful vertical bars" class="object-contain w-12 h-7" height="28"
                        loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/157a8bf6-ad5a-4d9d-f501-3808007acf2c.jpg"
                        width="48" />
                    <span class="text-sm font-semibold text-gray-900 whitespace-nowrap">
                        Total Courses
                    </span>
                    <div
                        class="px-3 py-1 ml-auto text-xs font-semibold text-white bg-indigo-900 rounded-full select-none">
                        1k+
                    </div>
                </div>
                <!-- Bottom left white rating box with slider and emoji -->
                <div
                    class="absolute bottom-[-55%] left-24 flex items-center space-x-4 bg-white rounded-xl px-5 py-2 shadow-md max-w-xs">
                    <span class="text-xs font-semibold text-gray-900 whitespace-nowrap">
                        Rate your experience
                    </span>
                    <input aria-label="Rate your experience slider"
                        class="h-1 rounded-full cursor-pointer w-28 accent-indigo-900" max="100" min="0" type="range"
                        value="50" />
                    <img alt="Emoji face with smiling expression" class="object-cover rounded-full w-7 h-7" height="28"
                        loading="lazy"
                        src="https://storage.googleapis.com/a1aa/image/c4bae558-807e-43cf-284b-1cdde4224d73.jpg"
                        width="28" />
                </div>
                <!-- Bottom right small white box with tutor avatars and plus icon -->
                <div
                    class="absolute bottom-[-30%] right-12 flex items-center space-x-2 bg-white rounded-lg px-4 py-1 shadow-md max-w-xs">
                    <span class="mr-2 text-xs font-semibold text-gray-700 select-none">
                        4k+ Registered Tutors
                    </span>
                    <div class="flex -space-x-3">
                        <img alt="Avatar of a female tutor with brown hair"
                            class="object-cover border-2 border-white rounded-full w-7 h-7" height="28" loading="lazy"
                            src="https://storage.googleapis.com/a1aa/image/a21625a8-8f6b-4978-e636-9f4140768ddf.jpg"
                            width="28" />
                        <img alt="Avatar of a male tutor with dark hair"
                            class="object-cover border-2 border-white rounded-full w-7 h-7" height="28" loading="lazy"
                            src="https://storage.googleapis.com/a1aa/image/3fab5f09-76fa-4394-f591-7cc5e80e4c60.jpg"
                            width="28" />
                        <img alt="Avatar of a female tutor with blonde hair"
                            class="object-cover border-2 border-white rounded-full w-7 h-7" height="28" loading="lazy"
                            src="https://storage.googleapis.com/a1aa/image/6410f78d-8dc7-439e-ac25-1e3f27f77c04.jpg"
                            width="28" />
                        <img alt="Avatar of a female tutor with red hair"
                            class="object-cover border-2 border-white rounded-full w-7 h-7" height="28" loading="lazy"
                            src="https://storage.googleapis.com/a1aa/image/98411cf9-296a-4663-a3eb-63df3fac6ccb.jpg"
                            width="28" />
                        <button aria-label="Add more tutors"
                            class="flex items-center justify-center text-xs font-bold text-white transition bg-indigo-900 border-2 border-white rounded-full w-7 h-7 hover:bg-indigo-800"
                            type="button">
                            +
                        </button>
                    </div>
                </div>
                <!-- Left and right purple donut shapes -->
                <img alt="Decorative purple donut shape on left side"
                    class="absolute hidden opacity-50 md:block top-20 -left-16 w-28 h-28" height="120" loading="lazy"
                    src="https://storage.googleapis.com/a1aa/image/6df14032-3e67-4682-fefc-a1a9c04e4ef5.jpg"
                    width="120" />
                <img alt="Decorative purple donut shape on right side"
                    class="absolute hidden opacity-50 md:block top-28 -right-16 w-28 h-28" height="120" loading="lazy"
                    src="https://storage.googleapis.com/a1aa/image/f2750073-229d-4789-89f3-d8376f6cc9e5.jpg"
                    width="120" />
            </div>
        </section>
    </div>
    <!-- Unlock Your Learning Potential Section -->
    <section class="px-6 mx-auto mt-20 max-w-7xl md:px-12">
        <h2 class="mb-2 text-lg font-semibold text-center text-gray-900 uppercase">
            Our Goal
        </h2>
        <h3 class="mb-4 text-3xl font-extrabold text-center">
            Unlock Your Learning Potential with
            <span class="text-indigo-600">
                Few Easy Steps
            </span>
        </h3>
        <p class="max-w-3xl mx-auto mb-12 text-center text-gray-600">
            Whether you want to improve your knowledge, skills, or confidence, our platform is designed to help you
            succeed.
        </p>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <div class="p-6 transition bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mb-4 text-yellow-600 bg-yellow-100 rounded-full">
                    <i class="text-xl fas fa-user-graduate">
                    </i>
                </div>
                <h4 class="mb-2 text-lg font-semibold">
                    Sign up &amp; create your account
                </h4>
                <p class="text-sm text-gray-600">
                    Start your journey by creating a free account and setting up your profile.
                </p>
            </div>
            <div class="p-6 transition bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mb-4 text-blue-600 bg-blue-100 rounded-full">
                    <i class="text-xl fas fa-search">
                    </i>
                </div>
                <h4 class="mb-2 text-lg font-semibold">
                    Explore our expert mentors &amp; courses
                </h4>
                <p class="text-sm text-gray-600">
                    Discover the best tutors and courses tailored to your learning goals.
                </p>
            </div>
            <div class="p-6 transition bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mb-4 text-green-600 bg-green-100 rounded-full">
                    <i class="text-xl fas fa-book-open">
                    </i>
                </div>
                <h4 class="mb-2 text-lg font-semibold">
                    Participate actively with live tutorials
                </h4>
                <p class="text-sm text-gray-600">
                    Engage in interactive sessions and get personalized feedback from mentors.
                </p>
            </div>
            <div class="p-6 transition bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md">
                <div class="flex items-center justify-center w-12 h-12 mb-4 text-pink-600 bg-pink-100 rounded-full">
                    <i class="text-xl fas fa-heart">
                    </i>
                </div>
                <h4 class="mb-2 text-lg font-semibold">
                    Enjoy learning &amp; achieve your goals
                </h4>
                <p class="text-sm text-gray-600">
                    Stay motivated and track your progress to reach your full potential.
                </p>
            </div>
        </div>
    </section>
    <!-- Empower Your Learning Section -->
    <section class="flex flex-col items-center gap-12 px-6 mx-auto mt-20 max-w-7xl md:px-12 md:flex-row">
        <div class="relative w-full overflow-hidden shadow-lg md:w-1/2 rounded-xl">
            <img alt="Woman explaining in an online classroom setting, gesturing with hands, sitting in front of laptop"
                class="object-cover w-full h-auto" height="400"
                src="https://storage.googleapis.com/a1aa/image/f50eefeb-dcfb-4dcb-3911-3e97be87c151.jpg" width="600" />
            <button aria-label="Play video"
                class="absolute inset-0 flex items-center justify-center text-5xl text-white transition bg-black bg-opacity-30 hover:text-green-400">
                <i class="fas fa-play-circle">
                </i>
            </button>
        </div>
        <div class="w-full md:w-1/2">
            <h3 class="mb-2 font-semibold text-indigo-600 uppercase">
                Our Expert Mentor
            </h3>
            <h2 class="mb-4 text-3xl font-extrabold">
                Empower Your Learning:
                <span class="text-green-500">
                    Unlock Your Potential
                </span>
            </h2>
            <p class="mb-6 leading-relaxed text-gray-700">
                Lernen is dedicated to providing you with the best learning experience possible. Our expert mentors are
                here to guide you every step of the way, helping you unlock your full potential and achieve your goals.
            </p>
            <div class="flex space-x-8 text-gray-700">
                <div>
                    <p class="text-lg font-semibold">
                        120+
                    </p>
                    <p class="text-sm">
                        Expert Mentors
                    </p>
                </div>
                <div>
                    <p class="text-lg font-semibold">
                        5000+
                    </p>
                    <p class="text-sm">
                        Courses
                    </p>
                </div>
                <div>
                    <p class="text-lg font-semibold">
                        10000+
                    </p>
                    <p class="text-sm">
                        Students
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Monitor & Keep Record Section -->
    <section class="px-6 mx-auto mt-20 max-w-7xl md:px-12">
        <h3 class="mb-4 text-xl font-semibold">
            Monitor &amp; Keep a Detailed Record of Your
            <span class="text-green-500">
                Learning Activities
            </span>
        </h3>
        <p class="max-w-3xl mb-6 leading-relaxed text-gray-700">
            Our platform allows you to track your progress, set goals, and review your learning history to stay
            motivated and on track.
        </p>
        <ul class="max-w-3xl mb-8 space-y-2 text-gray-700 list-disc list-inside">
            <li>
                Track your course completions and quiz scores.
            </li>
            <li>
                Set personalized learning goals and deadlines.
            </li>
            <li>
                Review detailed reports and analytics of your progress.
            </li>
        </ul>
        <div class="flex space-x-4">
            <button
                class="px-6 py-2 font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                Get Started
            </button>
            <button
                class="px-6 py-2 font-semibold text-indigo-600 transition border border-indigo-600 rounded-full hover:bg-indigo-50">
                Learn More
            </button>
        </div>
    </section>
    <!-- Mobile App Section -->
    <section
        class="relative flex flex-col items-center justify-between gap-8 p-8 mx-6 mt-20 overflow-hidden text-white bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-700 rounded-3xl md:mx-12 lg:mx-20 md:p-12 md:flex-row">
        <div class="max-w-xl">
            <h3 class="mb-2 text-lg font-semibold">
                Coming Soon
            </h3>
            <h2 class="mb-4 text-3xl font-extrabold">
                Lernen Mobile App
                <span class="text-green-400">
                    Available!
                </span>
            </h2>
            <p class="max-w-md mb-6 leading-relaxed">
                Take your learning on the go with our mobile app. Access courses, connect with tutors, and track your
                progress anytime, anywhere.
            </p>
            <div class="flex space-x-4">
                <a class="flex items-center px-6 py-3 space-x-3 font-semibold text-white transition bg-black rounded-full hover:bg-gray-900"
                    href="#">
                    <i class="text-xl fab fa-apple">
                    </i>
                    <span>
                        App Store
                    </span>
                </a>
                <a class="flex items-center px-6 py-3 space-x-3 font-semibold text-white transition bg-black rounded-full hover:bg-gray-900"
                    href="#">
                    <i class="text-xl fab fa-google-play">
                    </i>
                    <span>
                        Google Play
                    </span>
                </a>
            </div>
        </div>
        <div class="w-full md:w-1/3">
            <img alt="Mobile phone showing Lernen app screen with mentor photo and interface"
                class="shadow-lg rounded-3xl" height="560"
                src="https://storage.googleapis.com/a1aa/image/0f543df4-d3f7-42c7-0e12-e74bb31574c2.jpg" width="280" />
        </div>
    </section>
    <!-- Expert-Guided Courses Section -->
    <section class="px-6 mx-auto mt-20 max-w-7xl md:px-12">
        <h3 class="mb-2 font-semibold text-center text-indigo-600 uppercase">
            Popular Courses
        </h3>
        <h2 class="mb-4 text-3xl font-extrabold text-center">
            Achieve More with
            <span class="text-indigo-600">
                Expert-Guided Courses
            </span>
        </h2>
        <p class="max-w-3xl mx-auto mb-12 text-center text-gray-600">
            Learn from the best tutors with courses designed to help you succeed.
        </p>
        <div class="flex pb-4 space-x-6 overflow-x-auto scrollbar-hide">
            <!-- Course 1 -->
            <div
                class="min-w-[280px] bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition flex-shrink-0">
                <img alt="Course 1 thumbnail showing a woman tutor in a classroom"
                    class="object-cover w-full h-40 rounded-t-xl" height="160"
                    src="https://storage.googleapis.com/a1aa/image/5c30621f-2864-4835-2bda-3456163cf011.jpg"
                    width="280" />
                <div class="p-4">
                    <h4 class="mb-1 text-lg font-semibold">
                        Complete Python Bootcamp
                    </h4>
                    <p class="mb-2 text-sm text-gray-600">
                        Learn Python from scratch with hands-on projects.
                    </p>
                    <div class="flex items-center justify-between mb-2 text-sm text-gray-700">
                        <span>
                            By Jane Doe
                        </span>
                        <span>
                            4.8 ★
                        </span>
                    </div>
                    <div class="text-lg font-semibold text-indigo-600">
                        $299
                    </div>
                </div>
            </div>
            <!-- Course 2 -->
            <div
                class="min-w-[280px] bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition flex-shrink-0">
                <img alt="Course 2 thumbnail showing a woman tutor in a classroom"
                    class="object-cover w-full h-40 rounded-t-xl" height="160"
                    src="https://storage.googleapis.com/a1aa/image/f1b29a03-34d4-44ed-4ae4-20295d3ba5af.jpg"
                    width="280" />
                <div class="p-4">
                    <h4 class="mb-1 text-lg font-semibold">
                        Mastering Data Science
                    </h4>
                    <p class="mb-2 text-sm text-gray-600">
                        Advanced techniques for data analysis and visualization.
                    </p>
                    <div class="flex items-center justify-between mb-2 text-sm text-gray-700">
                        <span>
                            By Jane Doe
                        </span>
                        <span>
                            4.9 ★
                        </span>
                    </div>
                    <div class="text-lg font-semibold text-indigo-600">
                        $134
                    </div>
                </div>
            </div>
            <!-- Course 3 -->
            <div
                class="min-w-[280px] bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition flex-shrink-0">
                <img alt="Course 3 thumbnail showing a woman tutor in a classroom"
                    class="object-cover w-full h-40 rounded-t-xl" height="160"
                    src="https://storage.googleapis.com/a1aa/image/7975c3bd-f1c3-4556-837a-562cd03cba40.jpg"
                    width="280" />
                <div class="p-4">
                    <h4 class="mb-1 text-lg font-semibold">
                        Web Development Essentials
                    </h4>
                    <p class="mb-2 text-sm text-gray-600">
                        Build modern websites with HTML, CSS, and JavaScript.
                    </p>
                    <div class="flex items-center justify-between mb-2 text-sm text-gray-700">
                        <span>
                            By Jane Doe
                        </span>
                        <span>
                            4.7 ★
                        </span>
                    </div>
                    <div class="text-lg font-semibold text-indigo-600">
                        $168
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cutting-Edge Environment Section -->
    <section class="grid grid-cols-1 gap-12 px-6 mx-auto mt-20 max-w-7xl md:px-12 md:grid-cols-2">
        <div class="p-8 transition bg-white shadow-sm rounded-xl hover:shadow-md">
            <h3 class="mb-4 text-lg font-semibold">
                Become a Part of Our Learning Community
            </h3>
            <p class="mb-6 leading-relaxed text-gray-700">
                Join thousands of learners and tutors collaborating to create a supportive and innovative learning
                environment.
            </p>
            <button
                class="px-6 py-2 font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                Get Started
            </button>
            <div class="flex items-center mt-8 space-x-4">
                <img alt="Community logo with colorful icons" class="object-contain h-10" height="40"
                    src="https://storage.googleapis.com/a1aa/image/bd2d6261-5bea-4dba-eacd-ac56422bbbb1.jpg"
                    width="100" />
                <div class="text-sm text-gray-600">
                    <p>
                        1,200+ active members
                    </p>
                    <p>
                        500+ discussions weekly
                    </p>
                </div>
            </div>
        </div>
        <div class="p-8 transition bg-white shadow-sm rounded-xl hover:shadow-md">
            <h3 class="mb-4 text-lg font-semibold">
                Join as a Tutor to Offer Educational Expertise
            </h3>
            <p class="mb-6 leading-relaxed text-gray-700">
                Share your knowledge and help learners achieve their goals by becoming a certified tutor on our
                platform.
            </p>
            <button
                class="px-6 py-2 font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                Become a Tutor
            </button>
            <div class="grid grid-cols-3 gap-4 mt-8">
                <img alt="Photo of female tutor smiling with glasses" class="object-cover w-20 h-20 rounded-full"
                    height="80" src="https://storage.googleapis.com/a1aa/image/558c6932-0ca6-4aaa-694a-5b64a22b8f82.jpg"
                    width="80" />
                <img alt="Photo of male tutor smiling with beard" class="object-cover w-20 h-20 rounded-full"
                    height="80" src="https://storage.googleapis.com/a1aa/image/193b3f88-9eb7-48b0-c026-37c4e62b377a.jpg"
                    width="80" />
                <img alt="Photo of female tutor smiling with short hair" class="object-cover w-20 h-20 rounded-full"
                    height="80" src="https://storage.googleapis.com/a1aa/image/02316731-8535-41d7-b4a4-38e86df4ec7a.jpg"
                    width="80" />
                <img alt="Photo of male tutor smiling with glasses" class="object-cover w-20 h-20 rounded-full"
                    height="80" src="https://storage.googleapis.com/a1aa/image/49dc460d-0c15-4608-d935-b2d5dfe29a55.jpg"
                    width="80" />
                <img alt="Photo of female tutor smiling with long hair" class="object-cover w-20 h-20 rounded-full"
                    height="80" src="https://storage.googleapis.com/a1aa/image/432e05b7-a7e6-431b-762c-2a1038a94e37.jpg"
                    width="80" />
                <img alt="Photo of male tutor smiling with short hair" class="object-cover w-20 h-20 rounded-full"
                    height="80" src="https://storage.googleapis.com/a1aa/image/2fcd1fcc-22bc-4fb8-5317-ad56a6fc8945.jpg"
                    width="80" />
            </div>
        </div>
    </section>
    <!-- User Testimonials Section -->
    <section class="px-6 mx-auto mt-20 max-w-7xl md:px-12">
        <h3 class="mb-2 font-semibold text-center text-indigo-600 uppercase">
            What People Say
        </h3>
        <h2 class="mb-12 text-3xl font-extrabold text-center">
            What Our Users Are Saying
        </h2>
        <div class="flex pb-6 space-x-8 overflow-x-auto scrollbar-hide">
            <!-- Testimonial 1 -->
            <div
                class="min-w-[320px] bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition flex-shrink-0">
                <p class="mb-4 leading-relaxed text-gray-700">
                    "Lernen has transformed the way I learn. The expert mentors are incredibly supportive and the
                    courses are top-notch."
                </p>
                <div class="flex items-center space-x-4">
                    <img alt="Photo of user 1, a woman with short hair smiling"
                        class="object-cover w-12 h-12 rounded-full" height="48"
                        src="https://storage.googleapis.com/a1aa/image/3af034df-cba6-4ef2-a762-fecfac510463.jpg"
                        width="48" />
                    <div>
                        <p class="font-semibold text-gray-900">
                            Jessica P.
                        </p>
                        <p class="text-yellow-400">
                            ★★★★★
                        </p>
                    </div>
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div
                class="min-w-[320px] bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition flex-shrink-0">
                <p class="mb-4 leading-relaxed text-gray-700">
                    "The mobile app makes it so easy to learn on the go. I love the personalized feedback from tutors."
                </p>
                <div class="flex items-center space-x-4">
                    <img alt="Photo of user 2, a man with beard and glasses smiling"
                        class="object-cover w-12 h-12 rounded-full" height="48"
                        src="https://storage.googleapis.com/a1aa/image/1843290f-e87c-4e2f-52ab-9c2082236cea.jpg"
                        width="48" />
                    <div>
                        <p class="font-semibold text-gray-900">
                            Michael S.
                        </p>
                        <p class="text-yellow-400">
                            ★★★★★
                        </p>
                    </div>
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div
                class="min-w-[320px] bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition flex-shrink-0">
                <p class="mb-4 leading-relaxed text-gray-700">
                    "I highly recommend Lernen to anyone looking to improve their skills with expert guidance."
                </p>
                <div class="flex items-center space-x-4">
                    <img alt="Photo of user 3, a woman with long hair smiling"
                        class="object-cover w-12 h-12 rounded-full" height="48"
                        src="https://storage.googleapis.com/a1aa/image/8db389f3-efd5-4715-76b1-20328958cc35.jpg"
                        width="48" />
                    <div>
                        <p class="font-semibold text-gray-900">
                            Emily R.
                        </p>
                        <p class="text-yellow-400">
                            ★★★★★
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Handpicked Tutors Section -->
    <section class="px-6 mx-auto mt-20 text-center max-w-7xl md:px-12">
        <h3 class="mb-2 font-semibold text-indigo-600 uppercase">
            Our Tutors
        </h3>
        <h2 class="mb-4 text-3xl font-extrabold">
            Explore Our Handpicked Tutors
        </h2>
        <p class="max-w-3xl mx-auto mb-12 text-gray-600">
            Meet our expert tutors who are ready to help you achieve your learning goals.
        </p>
        <div class="grid max-w-5xl grid-cols-2 gap-8 mx-auto sm:grid-cols-4 md:grid-cols-5">
            <!-- Tutor 1 -->
            <div class="flex flex-col items-center p-4 bg-white shadow-sm rounded-xl">
                <img alt="Photo of female tutor smiling with long dark hair"
                    class="object-cover mb-4 rounded-full w-28 h-28" height="120"
                    src="https://storage.googleapis.com/a1aa/image/6c682ed5-33e7-4acb-6736-7a7f47defe47.jpg"
                    width="120" />
                <h4 class="mb-1 text-lg font-semibold">
                    Maria Smith
                </h4>
                <p class="mb-3 text-sm text-gray-600">
                    Mathematics Tutor
                </p>
                <button
                    class="px-4 py-1 text-sm font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                    View Profile
                </button>
            </div>
            <!-- Tutor 2 -->
            <div class="flex flex-col items-center p-4 bg-white shadow-sm rounded-xl">
                <img alt="Photo of male tutor smiling with beard and glasses"
                    class="object-cover mb-4 rounded-full w-28 h-28" height="120"
                    src="https://storage.googleapis.com/a1aa/image/86c6fbe1-f4eb-4f9f-0c5c-92ec06a83b6d.jpg"
                    width="120" />
                <h4 class="mb-1 text-lg font-semibold">
                    John Carter
                </h4>
                <p class="mb-3 text-sm text-gray-600">
                    Physics Tutor
                </p>
                <button
                    class="px-4 py-1 text-sm font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                    View Profile
                </button>
            </div>
            <!-- Tutor 3 -->
            <div class="flex flex-col items-center p-4 bg-white shadow-sm rounded-xl">
                <img alt="Photo of male tutor smiling with short hair" class="object-cover mb-4 rounded-full w-28 h-28"
                    height="120"
                    src="https://storage.googleapis.com/a1aa/image/2fcd1fcc-22bc-4fb8-5317-ad56a6fc8945.jpg"
                    width="120" />
                <h4 class="mb-1 text-lg font-semibold">
                    David Johnson
                </h4>
                <p class="mb-3 text-sm text-gray-600">
                    Chemistry Tutor
                </p>
                <button
                    class="px-4 py-1 text-sm font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                    View Profile
                </button>
            </div>
            <!-- Tutor 4 -->
            <div class="flex flex-col items-center p-4 bg-white shadow-sm rounded-xl">
                <img alt="Photo of male tutor smiling with dark hair" class="object-cover mb-4 rounded-full w-28 h-28"
                    height="120"
                    src="https://storage.googleapis.com/a1aa/image/79e652d0-13c6-44af-a1c2-e57b12e0dc6e.jpg"
                    width="120" />
                <h4 class="mb-1 text-lg font-semibold">
                    Alex Brown
                </h4>
                <p class="mb-3 text-sm text-gray-600">
                    Biology Tutor
                </p>
                <button
                    class="px-4 py-1 text-sm font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                    View Profile
                </button>
            </div>
            <!-- Tutor 5 -->
            <div class="flex flex-col items-center p-4 bg-white shadow-sm rounded-xl">
                <img alt="Photo of male tutor smiling with beard and checkered shirt"
                    class="object-cover mb-4 rounded-full w-28 h-28" height="120"
                    src="https://storage.googleapis.com/a1aa/image/5a491e3c-006f-443a-1b13-7c5422507676.jpg"
                    width="120" />
                <h4 class="mb-1 text-lg font-semibold">
                    James Wilson
                </h4>
                <p class="mb-3 text-sm text-gray-600">
                    English Tutor
                </p>
                <button
                    class="px-4 py-1 text-sm font-semibold text-white transition bg-indigo-600 rounded-full hover:bg-indigo-700">
                    View Profile
                </button>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="px-6 pt-12 pb-8 mt-20 text-indigo-200 bg-indigo-900 md:px-12">
        <div class="grid grid-cols-1 gap-12 mx-auto max-w-7xl md:grid-cols-4">
            <div>
                <img alt="Lernen logo in white" class="mb-6" height="40"
                    src="https://storage.googleapis.com/a1aa/image/a8cc2469-8313-4948-3e3c-eb2bd4ca0bd0.jpg"
                    width="140" />
                <p class="max-w-xs mb-6 text-sm">
                    Lernen is your go-to platform for expert mentoring and guided courses to unlock your full learning
                    potential.
                </p>
                <button
                    class="px-6 py-2 font-semibold text-indigo-900 transition bg-green-400 rounded-full hover:bg-green-500">
                    Subscribe Now
                </button>
                <div class="flex mt-6 space-x-4 text-xl text-indigo-300">
                    <a aria-label="Facebook" class="hover:text-white" href="#">
                        <i class="fab fa-facebook-f">
                        </i>
                    </a>
                    <a aria-label="Twitter" class="hover:text-white" href="#">
                        <i class="fab fa-twitter">
                        </i>
                    </a>
                    <a aria-label="Instagram" class="hover:text-white" href="#">
                        <i class="fab fa-instagram">
                        </i>
                    </a>
                    <a aria-label="LinkedIn" class="hover:text-white" href="#">
                        <i class="fab fa-linkedin-in">
                        </i>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="mb-4 font-semibold">
                    Our Company
                </h4>
                <ul class="space-y-2 text-sm text-indigo-300">
                    <li>
                        <a class="hover:text-white" href="#">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Careers
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Press
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="mb-4 font-semibold">
                    Customer Support
                </h4>
                <ul class="space-y-2 text-sm text-indigo-300">
                    <li>
                        <a class="hover:text-white" href="#">
                            Help Center
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Refund Policy
                        </a>
                    </li>
                    <li>
                        <a class="hover:text-white" href="#">
                            Accessibility
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="mb-4 font-semibold">
                    Download Our App
                </h4>
                <p class="mb-4 text-sm text-indigo-300">
                    Get the Lernen app for your mobile device and learn anytime, anywhere.
                </p>
                <div class="flex space-x-4">
                    <a class="block w-32" href="#">
                        <img alt="Download on the App Store badge" class="object-contain w-full h-auto" height="40"
                            src="https://storage.googleapis.com/a1aa/image/b7e93c77-9e05-4818-9be7-68d30c300970.jpg"
                            width="128" />
                    </a>
                    <a class="block w-32" href="#">
                        <img alt="Get it on Google Play badge" class="object-contain w-full h-auto" height="40"
                            src="https://storage.googleapis.com/a1aa/image/ea9ca4e7-32f7-47d1-adbd-6a6543f05253.jpg"
                            width="128" />
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-6 mt-12 text-xs text-center text-indigo-400 border-t border-indigo-800">
            © 2024 Lernen. All rights reserved.
        </div>
    </footer>
</body>