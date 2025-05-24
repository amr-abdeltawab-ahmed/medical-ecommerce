<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PharmaGo')</title>
    <link rel="icon" href="{{ asset('storage/icon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
<div class="min-h-screen flex flex-col">
    @auth
        @include('layouts.navigation')
    @else
        @include('layouts.guest-navigation')
    @endauth

    <!-- Page Heading -->
    @hasSection('header')
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
    @endif

    <!-- Flash Messages -->
    @if(session('success') || session('error'))
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-600 dark:bg-green-700 px-4 py-3 rounded relative" role="alert">
                    <p class="text-white font-bold">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded relative" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    @endif

    <!-- Page Content -->
    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')
</div>
</body>
</html>
