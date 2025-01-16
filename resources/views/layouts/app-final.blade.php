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
    <!-- Background with blur effect -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <!-- Enhanced gradient base -->
        <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50 to-indigo-100"></div>
        
        <!-- More visible elegant accents -->
        <div class="absolute inset-0">
            <!-- Main accent rectangle -->
            <div class="absolute top-0 right-0 w-1/2 h-screen 
                        bg-gradient-to-b from-blue-200/40 to-transparent
                        transform -skew-x-12">
            </div>
    
            <!-- Primary circle -->
            <div class="absolute top-20 right-20 w-96 h-96 
                        bg-gradient-to-br from-blue-100/50 to-indigo-200/30 
                        rounded-full">
            </div>
    
            <!-- Secondary circle -->
            <div class="absolute bottom-40 left-40 w-80 h-80 
                        bg-gradient-to-tr from-indigo-100/40 to-blue-200/20 
                        rounded-full">
            </div>
    
            <!-- Decorative rectangle -->
            <div class="absolute top-40 left-20 w-64 h-64 
                        bg-gradient-to-br from-blue-100/30 to-indigo-100/20 
                        rounded-lg transform rotate-12">
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <div class="min-h-[10vh] flex items-center justify-between bg-white/80 backdrop-blur-lg shadow-md border-b border-white/50">
        <div class="px-4 md:ml-10 flex justify-center items-center animate-fade-in">
            <a href="{{ route('home') }}" class="font-bold italic p-2 text-slate-800 hover:text-orange-600 transition duration-300">{{ config('app.name') }}</a>
        </div>

        <div class="absolute left-[47%] transform -translate-x-1/2 animate-fade-in-up">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo-ori.png') }}" alt="EduBridge Logo" class="w-auto h-[25px] sm:h-[30px] md:h-[35px] hover:scale-110 transition-transform duration-300">
            </a>
        </div>

        @if (Route::has('login'))
            <div class="flex gap-2 md:gap-6 px-4 md:mr-10 items-center animate-fade-in">
                @auth
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-2 px-3 md:px-5 py-2.5 bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] rounded-full font-medium text-sm text-slate-800 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300 ease-in-out">
                            <div class="h-3 w-3 bg-green-500 rounded-full"></div>
                            <span class="hidden sm:inline">{{ Auth::user()->first_name }}</span>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dynamic Sub-Navbar based on Role -->
                        @if (Auth::user()->isAdmin())
                            <!-- Admin Dropdown -->
                            <div class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-50">
                                <div class="px-1">
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('admin.batches.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Manajemen Batch
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Manajemen User
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Manajemen Kursus
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="block px-1">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 rounded-md">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif(Auth::user()->isMentor())
                            <!-- Mentor Dropdown -->
                            <div class="absolute right-0 w-[280px] mt-2 p-3 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-50">
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="#" class="flex flex-col items-center p-3 rounded-lg hover:bg-orange-50 transition-colors duration-200 group/item">
                                        <svg class="w-6 h-6 text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700 group-hover/item:text-orange-600">Dashboard</span>
                                    </a>
                                    <a href="#" class="flex flex-col items-center p-3 rounded-lg hover:bg-orange-50 transition-colors duration-200 group/item">
                                        <svg class="w-6 h-6 text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700 group-hover/item:text-orange-600">Kelas Saya</span>
                                    </a>
                                    <a href="#" class="flex flex-col items-center p-3 rounded-lg hover:bg-orange-50 transition-colors duration-200 group/item">
                                        <svg class="w-6 h-6 text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700 group-hover/item:text-orange-600">Tugas</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full flex flex-col items-center p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group/item">
                                            <svg class="w-6 h-6 text-red-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span class="text-sm font-medium text-red-600 group-hover/item:text-red-700">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Student Dropdown -->
                            <div class="absolute right-0 w-[280px] mt-2 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-50">
                                <div class="p-2 space-y-1">
                                    <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Dashboard</p>
                                            <p class="text-xs text-gray-500">Lihat ringkasan aktivitas Anda</p>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Kursus Saya</p>
                                            <p class="text-xs text-gray-500">Akses materi pembelajaran Anda</p>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Progress</p>
                                            <p class="text-xs text-gray-500">Pantau perkembangan belajar Anda</p>
                                        </div>
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 p-2 rounded-lg hover:bg-red-50 transition-all duration-200">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-red-600">Logout</p>
                                                <p class="text-xs text-red-500">Keluar dari akun Anda</p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <a href="{{ route('login') }}" class="relative px-3 md:px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full font-medium text-sm text-white hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 ease-in-out hover:scale-105 animate-fade-in-left">
                        Masuk
                    </a>

                    <div class="hidden sm:block h-6 w-[1px] bg-gray-300"></div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="relative px-3 md:px-5 py-2.5 bg-gradient-to-r from-orange-400 to-orange-300 rounded-full font-medium text-sm text-white hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 ease-in-out hover:scale-105 animate-fade-in-right">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer>
        <div class="max-w-screen flex flex-col md:flex-row items-start py-20 justify-between px-4 md:px-20 bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90%">
            <div class="w-full md:w-1/5 flex flex-col items-center justify-center gap-4 mb-8 md:mb-0">
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="max-h-[45px]">
                <h2 class="text-xl font-bold italic">
                    EduBridge
                </h2>
                <p class="text-slate-700 tracking-wide text-center md:text-left">
                    Platform pembelajaran digital yang menghubungkan siswa dengan mentor terbaik.
                </p>
            </div>
            <div class="w-full md:w-1/5 flex flex-col items-center md:items-start justify-center gap-4 mb-8 md:mb-0">
                <h2 class="text-xl font-bold tracking-wide">
                    PUSAT BANTUAN
                </h2>
                <div class="flex flex-col leading-relaxed items-center md:items-start">
                    <a href="#" class="hover:text-orange-700 transition duration-700">Kursus</a>
                    <a href="#" class="hover:text-orange-700 transition duration-700">Pendaftaran</a>
                    <a href="{{ route('about') }}" class="hover:text-orange-700 transition duration-700">Tentang Kami</a>
                </div>
            </div>
            <div class="w-full md:w-1/5 flex flex-col items-center md:items-start justify-center gap-4">
                <h2 class="text-xl font-bold tracking-wide">
                    INFO KONTAK
                </h2>
                <div class="flex flex-col leading-relaxed items-center md:items-start gap-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="#" class="hover:text-orange-700 transition duration-700">(021) 1234-5678</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="#" class="hover:text-orange-700 transition duration-700">info@edubridge.com</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Jakarta, Indonesia</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-[#1A1A1A] w-full flex items-center justify-center py-4">
            <p class="text-white text-sm tracking-wide">
                © {{ date('Y') }} EduBridge Team | All rights reserved
            </p>
        </div>
    </footer>

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

        .animation-delay-500 {
            animation-delay: 0.5s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-left {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fade-in-right {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }

        .animate-fade-in-left {
            animation: fade-in-left 1s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fade-in-right 1s ease-out forwards;
        }
    </style>
</body>

</html>
