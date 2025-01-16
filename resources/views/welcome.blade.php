<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EduBridge') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased" style="font-family: Mona sans">
    <!-- Background with blur effect -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100"></div>
        <div class="absolute inset-0">
            <div
                class="absolute top-20 left-20 w-48 md:w-72 h-48 md:h-72 bg-[#bae8ff] rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-blob">
            </div>
            <div
                class="absolute top-40 right-20 w-48 md:w-72 h-48 md:h-72 bg-[#ffe9d5] rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-40 w-48 md:w-72 h-48 md:h-72 bg-[#ffe1c5] rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-blob animation-delay-4000">
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <div
        class="min-h-[10vh] flex items-center justify-between bg-white/80 backdrop-blur-lg shadow-md border-b border-white/50">
        <div class="px-4 md:ml-10 flex justify-center items-center animate-fade-in">
            <h1 class="font-bold italic p-2 text-slate-800">{{ config('app.name') }}</h1>
        </div>

        <div class="absolute left-[47%] transform -translate-x-1/2 animate-fade-in-up">
            <img src="{{ asset('img/logo-ori.png') }}" alt="EduBridge Logo" class="w-auto h-[25px] sm:h-[30px] md:h-[35px]">
        </div>

        @if (Route::has('login'))
            <div class="flex gap-2 md:gap-6 px-4 md:mr-10 items-center animate-fade-in">
                @auth
                    <div class="relative group">
                        <button type="button"
                            class="flex items-center gap-2 px-3 md:px-5 py-2.5 bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] rounded-full font-medium text-sm text-slate-800 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300 ease-in-out">
                            <div class="h-3 w-3 bg-green-500 rounded-full"></div>
                            <span class="hidden sm:inline">{{ Auth::user()->first_name }}</span>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dynamic Sub-Navbar based on Role -->
                        @if (Auth::user()->isAdmin())
                            <!-- Admin Dropdown - Simple List -->
                            <div
                                class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-50">
                                <div class="px-1">
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('admin.batches.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Manajemen Batch
                                        {{-- @dd(Auth::user()->isAdmin()) --}}
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Manajemen User
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200 rounded-md">
                                        Manajemen Kursus
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="block px-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 rounded-md">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif(Auth::user()->isMentor())
                            <!-- Mentor Dropdown - Modern Grid -->
                            <div
                                class="absolute right-0 w-[280px] mt-2 p-3 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-50">
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="#"
                                        class="flex flex-col items-center p-3 rounded-lg hover:bg-orange-50 transition-colors duration-200 group/item">
                                        <svg class="w-6 h-6 text-orange-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-gray-700 group-hover/item:text-orange-600">Dashboard</span>
                                    </a>
                                    <a href="#"
                                        class="flex flex-col items-center p-3 rounded-lg hover:bg-orange-50 transition-colors duration-200 group/item">
                                        <svg class="w-6 h-6 text-orange-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-gray-700 group-hover/item:text-orange-600">Kelas
                                            Saya</span>
                                    </a>
                                    <a href="#"
                                        class="flex flex-col items-center p-3 rounded-lg hover:bg-orange-50 transition-colors duration-200 group/item">
                                        <svg class="w-6 h-6 text-orange-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-gray-700 group-hover/item:text-orange-600">Tugas</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex flex-col items-center p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group/item">
                                            <svg class="w-6 h-6 text-red-500 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium text-red-600 group-hover/item:text-red-700">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Student Dropdown - Modern Cards -->
                            <div
                                class="absolute right-0 w-[280px] mt-2 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-50">
                                <div class="p-2 space-y-1">
                                    <a href="#"
                                        class="flex items-center gap-3 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Dashboard</p>
                                            <p class="text-xs text-gray-500">Lihat ringkasan aktivitas Anda</p>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="flex items-center gap-3 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Kursus Saya</p>
                                            <p class="text-xs text-gray-500">Akses materi pembelajaran Anda</p>
                                        </div>
                                    </a>
                                    <a href="#"
                                        class="flex items-center gap-3 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
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
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 p-2 rounded-lg hover:bg-red-50 transition-all duration-200">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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
                    <a href="{{ route('login') }}"
                        class="relative px-3 md:px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full font-medium text-sm text-white hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 ease-in-out hover:scale-105 animate-fade-in-left">
                        Masuk
                    </a>

                    <div class="hidden sm:block h-6 w-[1px] bg-gray-300"></div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="relative px-3 md:px-5 py-2.5 bg-gradient-to-r from-orange-400 to-orange-300 rounded-full font-medium text-sm text-white hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 ease-in-out hover:scale-105 animate-fade-in-right">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    @guest
        <!-- Hero Section for Guest -->
        <div class="min-h-[90vh] flex items-center justify-center px-4 mb-8 sm:mb-0">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6 sm:space-y-8 animate-fade-in-up animation-delay-500 px-4 sm:px-6 md:px-8">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight tracking-tight text-slate-800">
                        <span class="block">Kembangkan Kemampuan,</span>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-orange-500 block mt-2">
                            Gapai Masa Depan
                        </span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 max-w-xl">
                        Platform pembelajaran yang menghubungkan siswa dengan mentor terbaik. Tingkatkan skillmu dan raih
                        karir impianmu bersama EduBridge.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-medium rounded-full hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105">
                            <span>Mulai Belajar</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#courses"
                            class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-white/80 backdrop-blur-sm text-slate-800 font-medium rounded-full hover:shadow-lg transition-all duration-300 hover:scale-105 border border-slate-200">
                            Lihat Kursus
                        </a>
                    </div>
                </div>

                <!-- Right Content - Stats -->
                <div class="space-y-8 animate-fade-in-up animation-delay-1000">

                    <div class="text-center space-y-2">
                        <h3 class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-orange-800">Didukung Oleh</h3>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('/img/logoipsum.svg') }}" alt="Company 1" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">IpsumCorp</span>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('/img/logoipsum2.svg') }}" alt="Company 2" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">IpsumSolutions</span>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('/img/logoipsum3.svg') }}" alt="Company 3" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">IpsumPro</span>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('icon.png') }}" alt="Company 4" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">FutureTech</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center bg-white/80 backdrop-blur-sm px-8 py-6 rounded-2xl border border-white/50 max-w-2xl mx-auto hover:shadow-lg transition-all duration-300 hover:scale-[1.02] group">
                        <div class="space-y-3">
                            <p class="text-slate-600 text-lg">
                                Lebih dari <span class="font-bold text-blue-600 text-2xl group-hover:text-orange-500 transition-colors duration-300">1000+</span> alumni telah berhasil berkarir di berbagai
                                <span class="italic font-medium">perusahaan teknologi terkemuka</span>
                            </p>
                            <div class="flex items-center justify-center gap-2 text-slate-500 text-sm">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Penyaluran pekerjaan terjamin secara langsung*</span>
                            </div>
                            <p class="text-end text-xs text-red-500">*SK berlaku</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    @auth
        <!-- Content for Logged In Users -->
        <div class="min-h-screen bg-gray-50">
            <!-- Welcome Banner -->
            <div class="bg-white shadow-sm border-b">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->first_name }}!
                            </h1>
                            <p class="mt-1 text-sm text-gray-500">
                                @if (Auth::user()->isStudent())
                                    Lanjutkan pembelajaran Anda
                                @elseif(Auth::user()->isMentor())
                                    Kelola kelas Anda
                                @else
                                    Kelola sistem EduBridge
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if (Auth::user()->isStudent())
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                    Student
                                </span>
                            @elseif(Auth::user()->isMentor())
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Mentor
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    Admin
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role-based Content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @if (Auth::user()->isStudent())
                    <!-- Student Dashboard -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Progress Overview -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Progress Belajar</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Kursus Aktif</span>
                                    <span class="text-sm font-medium text-gray-900">2 Kursus</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Jam Belajar</span>
                                    <span class="text-sm font-medium text-gray-900">24 Jam</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Tugas Selesai</span>
                                    <span class="text-sm font-medium text-gray-900">12/15</span>
                                </div>
                            </div>
                        </div>

                        <!-- Active Courses -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Kursus Aktif</h2>
                            <div class="space-y-4">
                                <a href="#" class="block hover:bg-gray-50 rounded-lg p-3 transition duration-150">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Web Development</p>
                                            <p class="text-xs text-gray-500">Progress: 60%</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Upcoming Tasks -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Tugas Mendatang</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Project Akhir</p>
                                        <p class="text-xs text-gray-500">Deadline: 3 hari lagi</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Auth::user()->isMentor())
                    <!-- Mentor Dashboard -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Class Overview -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Kelas</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Kelas</span>
                                    <span class="text-sm font-medium text-gray-900">3 Kelas</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Siswa</span>
                                    <span class="text-sm font-medium text-gray-900">45 Siswa</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Tugas Menunggu</span>
                                    <span class="text-sm font-medium text-gray-900">8 Tugas</span>
                                </div>
                            </div>
                        </div>

                        <!-- Active Classes -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Kelas Aktif</h2>
                            <div class="space-y-4">
                                <a href="#" class="block hover:bg-gray-50 rounded-lg p-3 transition duration-150">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Web Development Basic</p>
                                            <p class="text-xs text-gray-500">15 Siswa</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Recent Submissions -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Pengumpulan Terbaru</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Project Akhir - John Doe</p>
                                        <p class="text-xs text-gray-500">Dikumpulkan: 2 jam yang lalu</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Baru
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Admin Dashboard -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- System Overview -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Sistem</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Users</span>
                                    <span class="text-sm font-medium text-gray-900">250 Users</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Kursus</span>
                                    <span class="text-sm font-medium text-gray-900">15 Kursus</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Mentor</span>
                                    <span class="text-sm font-medium text-gray-900">12 Mentor</span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h2>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Pendaftaran User Baru</p>
                                        <p class="text-xs text-gray-500">2 menit yang lalu</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Baru
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
                            <div class="space-y-4">
                                <a href="{{ route('admin.batches.index') }}"
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700">
                                    Kelola Batch
                                </a>
                                <button
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                    Kelola User
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Common Section: Available Courses -->
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        @if (Auth::user()->isStudent())
                            Rekomendasi Kursus
                        @elseif(Auth::user()->isMentor())
                            Kursus yang Anda Ajar
                        @else
                            Semua Kursus
                        @endif
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach (\App\Models\Course::all() as $course)
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300">
                                <img src="{{ $course->image ?? asset('img/course-placeholder.jpg') }}"
                                    class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $course->name }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $course->status ?? 'Available' }}</p>
                                    @if (Auth::user()->isAdmin())
                                        <div class="mt-4 flex justify-end">
                                            <button class="text-sm text-blue-600 hover:text-blue-800">Edit</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Content for Non-Logged In Users -->
        <!-- Header -->
        <header
            class="flex flex-col items-center justify-center h-[20vh] bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90% relative shadow-xl">
            <h2 class="text-2xl font-semibold">Get skilled with</h2>
            <h1
                class="text-3xl font-bold bg-gradient-to-r from-black via-gray-400 to-gray-900 bg-clip-text text-transparent tracking-tight">
                Payless Education</h1>
        </header>

        <!-- Elegant Transition Section -->
        <div class="relative py-20 overflow-hidden">
            <div class="relative max-w-5xl mx-auto">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-gray-200/60">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <svg class="w-16 h-16 text-orange-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <p class="text-lg text-gray-700 leading-relaxed max-w-3xl">
                            <b>EduBridge</b> memfasilitasi pemberian beasiswa dari perusahaan kepada
                            peserta pelatihan, serta membantu menghubungkan lulusan dengan peluang kerja di
                            perusahaan mitra.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requirements Section -->
        <div class="max-w-screen py-20 bg-gradient-to-r from-[#bae8ff]/10 via-white to-[#bae8ff]/10">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-orange-800 mb-4">Persyaratan Program</h2>
                </div>

                <div class="flex flex-col md:flex-row items-stretch justify-center gap-6 md:gap-8">
                    @foreach ($requirements as $requirement)
                        <div class="group relative w-full md:w-[350px] h-[300px] rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <div class="absolute inset-0">
                                <img src="{{ $requirement['img'] }}" alt="Requirement Image" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/80"></div>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform transition-transform duration-300">
                                <div class="bg-white/90 backdrop-blur-sm text-gray-800 text-sm px-4 py-2 rounded-lg mb-3 shadow-lg">
                                    {{ $requirement['requirement'] }}
                                </div>
                                <h3 class="font-bold text-lg">
                                    {{ $requirement['statement'] }}
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Preview Courses Section -->
        <div class="max-w-screen min-h-[1500px] flex relative">
            <img src="/img/logo.png" alt="background"
                class="absolute min-h-[400px] m-auto inset-0 opacity-10 object-cover z-0">

            <div class="w-screen flex flex-col items-center justify-start z-10">
                <div class="flex flex-col items-center mt-32">
                    <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-orange-900 text-[36px] font-bold tracking-tight">Program Kursus</h1>
                </div>

                <div class="container mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 gap-8 mt-12 max-w-4xl">
                    @foreach (\App\Models\Course::all() as $course)
                        <a href="#" class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="relative">
                                <img src="{{ $course->image ?? asset('img/course-placeholder.jpg') }}"
                                    class="w-full h-52 object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                            <div class="p-6">
                                <h2 class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $course->name }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endauth

    <div class="max-w-screen min-h-[400px] flex relative">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-3xl mx-auto text-center">

                @php
                    $quotes = [
                        ["text" => "Pendidikan adalah senjata paling ampuh yang dapat kamu gunakan untuk mengubah dunia.", "author" => "Nelson Mandela"],
                        ["text" => "Belajar tanpa berpikir itu tidaklah berguna, berpikir tanpa belajar itu berbahaya.", "author" => "Confucius"],
                        ["text" => "Kesuksesan bukanlah akhir, kegagalan bukanlah fatal. Keberanian untuk melanjutkan adalah yang terpenting.", "author" => "Winston Churchill"],
                        ["text" => "Masa depan tergantung pada apa yang kita lakukan hari ini.", "author" => "Mahatma Gandhi"],
                        ["text" => "Jangan pernah menyerah pada mimpimu, ikuti jalan hatimu.", "author" => "EduBridge's Team"]
                    ];
                    $randomQuote = $quotes[array_rand($quotes)];
                @endphp

                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                    <blockquote class="text-xl italic text-gray-800 mb-4">
                        "{{ $randomQuote['text'] }}"
                    </blockquote>
                    <p class="text-gray-600">- {{ $randomQuote['author'] }}</p>
                    <div class="flex items-center justify-center mt-4">
                        <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div
            class="max-w-screen flex flex-col md:flex-row items-start py-20 justify-between px-4 md:px-20 bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90%">
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
                    <a href="#" class="hover:text-orange-700 transition duration-700">Reviews</a>
                    <a href="{{ route('about') }}" class="hover:text-orange-700 transition duration-700">Tentang Kami</a>
                </div>
            </div>
            <div class="w-full md:w-1/5 flex flex-col items-center md:items-start justify-center gap-4">
                <h2 class="text-xl font-bold tracking-wide">
                    INFO KONTAK
                </h2>
                <div class="flex flex-col leading-relaxed items-center md:items-start">
                    <a href="#" class="hover:text-orange-700 transition duration-700">{{$contact['phone']}}</a>
                    <a href="#" class="hover:text-orange-700 transition duration-700">{{$contact['email']}}</a>
                    <a href="#" class="hover:text-orange-700 transition duration-700">{{$contact['address']}}</a>
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
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
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
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
