<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EduBridge') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased" style="font-family: Mona sans">
    <!-- Navbar -->
    <div class="min-h-[10vh] flex items-center justify-between bg-white/80 backdrop-blur-lg shadow-md border-b border-white/50">
        <div class="px-4 md:ml-10 flex items-center space-x-8 animate-fade-in">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="font-bold italic p-2 text-slate-800 hover:text-orange-600 transition duration-300">
                {{ config('app.name') }}
            </a>

            <!-- Navigation Links -->
            @if (Auth::user()->isAdmin())
                <!-- Admin Navigation -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.batches.index')" :active="request()->routeIs('admin.batches.*')">
                        {{ __('Kelola Batch') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.mentors.index')" :active="request()->routeIs('admin.mentors.*')">
                        {{ __('Kelola Mentor') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.profile')" :active="request()->routeIs('admin.profile')">
                        {{ __('Profil') }}
                    </x-nav-link>
                </div>
            @elseif (Auth::user()->isMentor())
                <!-- Mentor Navigation -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('mentor.dashboard')" :active="request()->routeIs('mentor.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('mentor.profile')" :active="request()->routeIs('mentor.profile')">
                        {{ __('Profil') }}
                    </x-nav-link>
                </div>
            @else
                <!-- Student Navigation -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('student.profile')" :active="request()->routeIs('student.profile')">
                        {{ __('Profil') }}
                    </x-nav-link>
                </div>
            @endif
        </div>

        <!-- Right Side -->
        <div class="flex items-center px-4 md:mr-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-3 md:px-5 py-2.5 bg-red-50 rounded-full font-medium text-sm text-red-600 hover:bg-red-100 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }
    </style>
</body>

</html>
