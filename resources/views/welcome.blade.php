<x-app-final-layout>
    <style>
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes pulseSlow {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        .animate-fade-in-left {
            animation: fadeInLeft 1s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fadeInRight 1s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 8s ease infinite;
        }

        .animate-pulse-slow {
            animation: pulseSlow 3s ease-in-out infinite;
        }

        .animation-delay-300 {
            animation-delay: 300ms;
        }

        .animation-delay-500 {
            animation-delay: 500ms;
        }

        .animation-delay-700 {
            animation-delay: 700ms;
        }

        .animation-delay-1000 {
            animation-delay: 1000ms;
        }

        .animation-delay-\[800ms\] {
            animation-delay: 800ms;
        }

        .animation-delay-\[1000ms\] {
            animation-delay: 1000ms;
        }

        .animation-delay-\[1200ms\] {
            animation-delay: 1200ms;
        }

        .animation-delay-\[1400ms\] {
            animation-delay: 1400ms;
        }

        .animation-delay-\[1600ms\] {
            animation-delay: 1600ms;
        }
    </style>
    @guest
        <!-- Hero Section for Guest -->
        <div class="min-h-[90vh] flex items-center justify-center px-4 mb-8 sm:mb-0">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[1.62fr,1fr] gap-12 items-center mt-16 lg:mt-0">
                <!-- Left Content -->
                <div class="space-y-6 sm:space-y-8 animate-fade-in-left animation-delay-300 px-4 sm:px-6 md:px-8">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight tracking-tight text-slate-800 animate-fade-in-up animation-delay-500">
                        <span class="block">Get Skilled with</span>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-orange-500 block mt-2 animate-gradient">
                            Payless Education
                        </span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 max-w-xl animate-fade-in-up animation-delay-700">
                        Platform pembelajaran yang menghubungkan siswa dengan mentor terbaik. Tingkatkan skillmu dan raih
                        karir impianmu bersama EduBridge.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up animation-delay-1000">
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-medium rounded-full hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 animate-pulse-slow">
                            <span>Mulai Belajar</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#courses"
                            class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-white/80 backdrop-blur-sm text-slate-800 font-medium rounded-full hover:shadow-lg transition-all duration-300 hover:scale-105 border border-slate-200 animate-fade-in">
                            Lihat Kursus
                        </a>
                    </div>
                </div>

                <!-- Right Content - Stats -->
                <div class="space-y-8 animate-fade-in-right animation-delay-500">
                    <div class="text-center space-y-2 animate-fade-in-up animation-delay-700">
                        <h3 class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-orange-800">Didukung Oleh</h3>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group animate-fade-in-up animation-delay-[800ms]">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('/img/logoipsum.svg') }}" alt="Company 1" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">IpsumCorp</span>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group animate-fade-in-up animation-delay-[1000ms]">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('/img/logoipsum2.svg') }}" alt="Company 2" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">IpSions</span>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group animate-fade-in-up animation-delay-[1200ms]">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('/img/logoipsum3.svg') }}" alt="Company 3" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">IpsumPro</span>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white/50 hover:shadow-lg transition-all duration-300 hover:scale-105 group animate-fade-in-up animation-delay-[1400ms]">
                            <div class="flex flex-col items-center space-y-2">
                                <img src="{{ asset('icon.png') }}" alt="Company 4" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
                                <span class="text-sm font-medium text-slate-600">FutureTech</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center bg-white/80 backdrop-blur-sm px-8 py-6 rounded-2xl border border-white/50 max-w-2xl mx-auto hover:shadow-lg transition-all duration-300 hover:scale-[1.02] group animate-fade-in-up animation-delay-[1600ms]">
                        <div class="space-y-3">
                            <p class="text-slate-600 text-lg">
                                Lebih dari <span class="font-bold text-blue-600 text-2xl group-hover:text-orange-500 transition-colors duration-300 animate-pulse-slow">1000+</span> alumni telah berhasil berkarir di berbagai
                                <span class="italic font-medium">perusahaan teknologi terkemuka</span>
                            </p>
                            <div class="flex items-center justify-center gap-2 text-slate-500 text-sm">
                                <svg class="w-5 h-5 text-orange-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        <!-- Get Skilled Section -->
        <div class="w-full bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90% py-12 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center animate-fade-in-up animation-delay-300">
                    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-orange-800 mb-12">Persyaratan Peserta</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                        @foreach($requirements as $requirement)
                            <div class="bg-white/80 rounded-xl shadow-md border border-white/50 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col h-[280px] group animate-fade-in-up animation-delay-[{{ 500 + $loop->index * 200 }}ms]">
                                <div class="h-[140px] w-full bg-gradient-to-b from-orange-50/50 to-white/50 relative overflow-hidden">
                                    <img src="{{ asset($requirement['img']) }}" alt="Requirement Icon" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-semibold text-slate-800 mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-blue-400 group-hover:bg-clip-text transition-colors duration-300">{{ $requirement['statement'] }}</h3>
                                    <p class="text-slate-600 text-sm">{{ $requirement['requirement'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endguest

    @auth
        <!-- Content for Logged In Users -->
        <div class="min-h-screen bg-white/20">
            <!-- Welcome Banner -->
            <div class="bg-white shadow-sm border-b">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->first_name }}!</h1>
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
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                    Student
                                </span>
                            @elseif(Auth::user()->isMentor())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Mentor
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
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
                                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
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
                                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
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
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300">
                                <img src="{{ $course->image ?? asset('img/course-placeholder.jpg') }}" class="w-full h-48 object-cover">
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
    @endauth

    <!-- Preview Courses Section -->
    @guest
        <div class="max-w-screen min-fit flex relative">
            <div class="w-screen flex flex-col items-center justify-start z-10">
                <div class="flex flex-col items-center mt-32 animate-fade-in-up animation-delay-300">
                    <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-orange-900 text-[36px] font-bold tracking-tight">Program Kursus</h1>
                </div>

                <div class="container mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 gap-8 mt-12 max-w-4xl">
                    @foreach (\App\Models\Course::all() as $course)
                        <a href="#" class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up animation-delay-[{{ 500 + $loop->index * 200 }}ms]">
                            <div class="relative">
                                <img src="{{ $course->image ?? asset('img/course-placeholder.jpg') }}" class="w-full h-52 object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                            <div class="p-6">
                                <h2 class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $course->name }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endguest

    @guest
    <div class="max-w-screen min-h-[400px] flex relative">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-3xl mx-auto text-center animate-fade-in-up animation-delay-300">
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
                    <blockquote class="text-xl italic text-gray-800 mb-4 animate-fade-in-up animation-delay-500">
                        "{{ $randomQuote['text'] }}"
                    </blockquote>
                    <p class="text-gray-600 animate-fade-in-up animation-delay-700">- {{ $randomQuote['author'] }}</p>
                    <div class="flex items-center justify-center mt-4 animate-fade-in-up animation-delay-1000">
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
    @endguest
</x-app-final-layout>
