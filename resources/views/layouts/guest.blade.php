<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .alert-info {
            background-color: #4CAF50;
            /* Green background */
            color: white;
            /* White text */
            font-weight: bold;
            border-radius: 5px;
            position: absolute;
            top: 2%;
            right: 1%;
            padding: 15px 30px;
            z-index: 1;
        }

        .alert-info .btn-close {
            color: white;
            /* Close button color */
        }
    </style>

</head>

<body class="font-sans antialiased text-gray-900">
    @if (session('message') && session('message') != '')
        <div class="alert alert-info alert-dismissible fade show" role="alert" id="alertMessage">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            // Timer to hide the alert after 5 seconds
            setTimeout(function () {
                var alert = document.getElementById('alertMessage');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                }
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>
    @endif


    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>