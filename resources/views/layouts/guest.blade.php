<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Mona_Sans'] antialiased bg-gradient-to-br from-slate-50 to-slate-100/50 relative min-h-full">
        <!-- Background Elements -->
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <!-- Enhanced gradient base -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50 to-indigo-100"></div>
            
            <!-- Animated elegant accents -->
            <div class="absolute inset-0">
                <!-- Main accent rectangle -->
                <div class="absolute top-0 right-0 w-1/2 h-screen 
                            bg-gradient-to-b from-blue-200/40 to-transparent
                            transform -skew-x-12">
                </div>
        
                <!-- Primary animated circle -->
                <div class="absolute top-20 right-20 w-96 h-96 
                            bg-gradient-to-br from-blue-100/50 to-indigo-200/30 
                            rounded-full
                            animate-[float_8s_ease-in-out_infinite]">
                </div>
        
                <!-- Orange accent circle -->
                <div class="absolute bottom-40 left-40 w-80 h-80 
                            bg-gradient-to-tr from-orange-100/30 to-orange-200/20 
                            rounded-full
                            animate-[float_10s_ease-in-out_infinite_reverse]">
                </div>
        
                <!-- Decorative rectangle with orange accent -->
                <div class="absolute top-40 left-20 w-64 h-64 
                            bg-gradient-to-br from-blue-100/30 via-orange-100/20 to-indigo-100/20 
                            rounded-lg transform rotate-12
                            animate-[rotate_35s_linear_infinite]">
                </div>
            </div>
        </div>
        <style>
            @keyframes float {
                0%, 100% { transform: translate(0, 0); }
                50% { transform: translate(0, 20px); }
            }
            
            @keyframes rotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            </style>

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
