<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'EduBridge') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased" style="font-family: Mona sans">
        <div class="min-h-[10vh] flex items-center bg-white shadow-md">
            <div class="ml-10 mr-auto flex justify-center items-center">
                <h1 class="font-bold italic p-2">{{ config('app.name') }}</h1>
            </div>
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="max-h-[35px]">
            </div>
            @if (Route::has('login'))
                <div class="flex gap-6 mr-10 ml-auto items-center">
                    @auth
                        <div class="flex items-center gap-3">
                            <a href="{{ url('/dashboard') }}"
                               class="group relative px-5 py-2.5 bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] rounded-full font-medium text-sm text-slate-800 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300 ease-in-out">
                                <span class="relative flex items-center gap-2"><div class="h-3 w-3 bg-green-500 rounded-full"></div>{{ Auth::user()->first_name }}</span>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="relative px-5 py-2.5 bg-gradient-to-r from-slate-600 to-slate-400 rounded-full font-medium text-sm text-white hover:shadow-lg hover:shadow-slate-500/30 transition-all duration-300 ease-in-out hover:scale-105">
                            Log in
                        </a>

                        <div class="h-6 w-[1px] bg-gray-300"></div>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="relative px-5 py-2.5 bg-gradient-to-r from-[#bae8ff] to-[#e2f5ff] rounded-full font-medium text-sm text-slate-800 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 ease-in-out hover:scale-105">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <!-- Elegant Transition Section -->
        <div class="relative py-20 overflow-hidden bg-gradient-to-b from-[#ffe9d5]/50 to-white">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-orange-50 opacity-30"></div>
                <div class="absolute inset-0 bg-grid-slate-900/[0.04] bg-[size:20px_20px]"></div>
            </div>
            <div class="relative max-w-5xl mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-gray-200/60">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div class="w-16 h-1 bg-orange-400 rounded-full mb-4"></div>
                        <p class="text-lg text-gray-700 leading-relaxed max-w-3xl">
                            <b>EduBridge</b> memfasilitasi pemberian beasiswa dari perusahaan kepada
                            peserta pelatihan, serta membantu menghubungkan lulusan dengan peluang kerja di
                            perusahaan mitra.
                        </p>
                        <div class="w-16 h-1 bg-orange-400 rounded-full mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="flex flex-col items-center justify-center h-[20vh] bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90% relative">
            <h2 class="text-2xl font-semibold">Get skilled with</h2>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-black via-gray-400 to-gray-900 bg-clip-text text-transparent tracking-tight">Payless Education</h1>
        </header>

        @auth
        <!-- Dynamic Sub-Navbar based on Role -->
        <div class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-8">
                        @if(Auth::user()->hasRole('admin'))
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Dashboard
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Manajemen User
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Manajemen Kursus
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                        @elseif(Auth::user()->hasRole('mentor'))
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Dashboard
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Kelas Saya
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Tugas & Penilaian
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                        @else
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Dashboard
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Kursus Saya
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="#" class="text-gray-700 hover:text-orange-500 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Progress
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <!-- Features Section -->
        <section id="features" class="py-20 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900">Kenapa Memilih EduBridge?</h2>
                    <p class="mt-4 text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                        Kami menyediakan berbagai fitur yang membantu Anda mencapai tujuan pembelajaran.
                    </p>
                </div>
            </div>
        </section>

        <div class="max-w-screen flex flex-col items-center justify-center h-[20vh] bg-gradient-to-r from-[#bae8ff]/30 from-10% via-[#e2f5ff]/30 via-45% to-[#bae8ff]/30 to-90% min-h-[50vh]">
            <div class="flex flex-row items-center justify-center gap-8 w-5/6 bg-white rounded-xl p-4 shadow-md">
                @foreach ( $requirements as $requirement )
                <div class="h-[270px] w-fit flex flex-col items-start justify-end rounded-xl" style="background-image: url('{{ $requirement['img'] }}'); background-size: cover; background-position: center;">
                    <p class="text-[12px] text-slate-800 p-2 bg-white mx-4 my-2 rounded-md">{{ $requirement['requirement'] }}</p>
                    <h1 class="font-bold text-white w-full bg-black/30 px-4 py-2 rounded-b-xl">{{ $requirement['statement'] }}</h1>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Courses Section -->
        <div class="max-w-screen min-h-[1500px] flex relative">
            <img src="/img/logo.png"
                 alt="background"
                 class="absolute min-h-[400px] m-auto inset-0 opacity-10 object-cover z-0">

            <div class="w-screen flex flex-col items-center justify-start z-10">
                <div class="flex flex-col items-center mt-32">
                    <h1 class="text-[#1A1A1A] text-[36px] font-bold">COURSES</h1>
                    <div class="bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fef2e5] via-45% to-[#ffe1c5] to-90% w-[8vw] h-2 rounded-full"></div>
                </div>
                <div class="mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
                    @foreach(\App\Models\Course::all() as $course)
                    <a href="#" class="shadow-lg w-fit bg-white rounded-3xl hover:shadow-2xl transition duration-600">
                        <img src="{{ $course->image_url ?? asset('img/course-placeholder.jpg') }}" class="max-h-[266px] p-2">
                        <h2 class="text-[20px] font-bold ml-4">{{ $course->name }}</h2>
                        <p class="text-[13px] font-medium text-[#9A9A9A] ml-4 pb-2">{{ $course->status ?? 'Available' }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="max-w-screen flex flex-row items-start py-20 justify-between px-20 bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90%">
                <div class="w-1/5 flex flex-col items-center justify-center gap-4">
                    <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="max-h-[45px]">
                    <h2 class="text-xl font-bold italic">
                        EduBridge
                    </h2>
                    <p class="text-slate-700 tracking-wide">
                        Platform pembelajaran digital yang menghubungkan siswa dengan mentor terbaik.
                    </p>
                </div>
                <div class="w-1/5 flex flex-col items-start justify-center gap-4">
                    <h2 class="text-xl font-bold tracking-wide">
                        PUSAT BANTUAN
                    </h2>
                    <div class="flex flex-col leading-relaxed">
                        <a href="#" class="hover:text-orange-700 transition duration-700">Kursus</a>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Pendaftaran</a>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Reviews</a>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Tentang Kami</a>
                    </div>
                </div>
                <div class="w-1/5 flex flex-col items-start justify-center gap-4">
                    <h2 class="text-xl font-bold tracking-wide">
                        INFO KONTAK
                    </h2>
                    <div class="flex flex-col leading-relaxed">
                        <a>+62 812-3456-7890</a>
                        <a>info@edubridge.com</a>
                        <a>Jl. Pendidikan No. 123, Jakarta</a>
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
        </style>

        <script>
            // Mobile menu toggle
            document.querySelector('.mobile-menu-button').addEventListener('click', function() {
                document.querySelector('.mobile-menu').classList.toggle('hidden');
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </body>
</html>
