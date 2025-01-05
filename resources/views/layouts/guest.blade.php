<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduBridge') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Mona_Sans'] antialiased bg-gradient-to-br from-slate-50 to-slate-100/50 relative min-h-full">
        <!-- Background Elements -->
        <div class="fixed inset-0 -z-10">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Background" class="absolute top-0 left-0 w-[800px] opacity-[0.02] -rotate-12">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Background" class="absolute bottom-0 right-0 w-[800px] opacity-[0.02] rotate-12">
            <div class="absolute top-20 left-20 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-10 animate-blob"></div>
            <div class="absolute top-40 right-40 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-2xl opacity-10 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-20 left-40 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-10 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Main Content -->
        <main class="relative py-12 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>
    </body>
</html>
