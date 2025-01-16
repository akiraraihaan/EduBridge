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
        
        <!-- Animated elegant accents -->
        <div class="absolute inset-0">
            <!-- Main accent rectangle -->
            <div class="absolute top-0 right-0 w-1/2 h-screen 
                        bg-gradient-to-b from-blue-200/40 to-transparent
                        transform -skew-x-12">
            </div>
    
            <!-- Primary animated shape -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200" width="400" height="400" class="absolute top-20 right-20 animate-[float_8s_ease-in-out_infinite] opacity-10">
                <g clip-path="url(#cs_clip_1_misc-9)">
                    <mask id="cs_mask_1_misc-9" style="mask-type:alpha" width="200" height="200" x="0" y="0" maskUnits="userSpaceOnUse">
                        <path fill="#fff" d="M8.475 78.884C27.008 22.9 70.833 4.108 89.905 1.464c110.239-15.283 132.313 92.87 90.046 148.772-36.448 48.204-100.638 57.186-139.16 44.676C6.86 183.894-11.983 140.686 8.475 78.884z"></path>
                    </mask>
                    <g mask="url(#cs_mask_1_misc-9)">
                        <path fill="#fff" d="M200 0H0v200h200V0z"></path>
                        <path fill="url(#paint0_linear_748_4999)" d="M200 0H0v200h200V0z"></path>
                        <g filter="url(#filter0_f_748_4999)">
                            <ellipse cx="143.777" cy="167.536" fill="#FB923C" fill-opacity="0.4" rx="91.994" ry="58.126" transform="rotate(-33.875 143.777 167.536)"></ellipse>
                            <ellipse cx="68.482" cy="38.587" fill="#3B82F6" fill-opacity="0.3" rx="69.531" ry="47.75" transform="rotate(-26.262 68.482 38.587)"></ellipse>
                        </g>
                    </g>
                </g>
                <defs>
                    <filter id="filter0_f_748_4999" width="384.137" height="412.095" x="-77.372" y="-94.144" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                        <feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                        <feGaussianBlur result="effect1_foregroundBlur_748_4999" stdDeviation="40"></feGaussianBlur>
                    </filter>
                    <linearGradient id="paint0_linear_748_4999" x1="158.5" x2="29" y1="12.5" y2="200" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#BFDBFE"></stop>
                        <stop offset="1" stop-color="#93C5FD"></stop>
                    </linearGradient>
                    <clipPath id="cs_clip_1_misc-9">
                        <path fill="#fff" d="M0 0H200V200H0z"></path>
                    </clipPath>
                </defs>
            </svg>
    
            <!-- Orange accent circle -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200" width="320" height="320" 
                 class="absolute bottom-40 left-40 animate-[float_10s_ease-in-out_infinite_reverse] opacity-30">
                <g clip-path="url(#cs_clip_1_polygon-7)">
                    <mask id="cs_mask_1_polygon-7" style="mask-type:alpha" width="182" height="200" x="9" y="0" maskUnits="userSpaceOnUse">
                        <path fill="#fff" d="M86.449 3.601a27.296 27.296 0 0127.102 0l63.805 36.514C185.796 44.945 191 53.9 191 63.594v72.812c0 9.694-5.204 18.649-13.644 23.479l-63.805 36.514a27.3 27.3 0 01-27.102 0l-63.805-36.514C14.204 155.055 9 146.1 9 136.406V63.594c0-9.694 5.204-18.649 13.644-23.48L86.45 3.602z"></path>
                    </mask>
                    <g mask="url(#cs_mask_1_polygon-7)">
                        <path fill="#fff" d="M200 0H0v200h200V0z"></path>
                        <path fill="url(#paint0_linear_polygon-7)" fill-opacity="0.3" d="M200 0H0v200h200V0z"></path>
                        <g filter="url(#filter0_f_748_4355)">
                            <path fill="#FB923C" fill-opacity="0.3" d="M209 126H-9v108h218V126z"></path>
                            <ellipse cx="87" cy="57.5" fill="#FED7AA" fill-opacity="0.3" rx="59" ry="34.5"></ellipse>
                        </g>
                    </g>
                </g>
                <defs>
                    <filter id="filter0_f_748_4355" width="338" height="331" x="-69" y="-37" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                        <feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                        <feGaussianBlur result="effect1_foregroundBlur_748_4355" stdDeviation="30"></feGaussianBlur>
                    </filter>
                    <linearGradient id="paint0_linear_polygon-7" x1="162" x2="49.5" y1="38" y2="150.5" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FB923C" stop-opacity="0.3"></stop>
                        <stop offset="1" stop-color="#FFEDD5" stop-opacity="0.2"></stop>
                    </linearGradient>
                    <clipPath id="cs_clip_1_polygon-7">
                        <path fill="#fff" d="M0 0H200V200H0z"></path>
                    </clipPath>
                </defs>
            </svg>
    
            <!-- Decorative star shape -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200" width="256" height="256" 
                 class="absolute top-40 left-20 animate-[rotate_25s_linear_infinite]">
                <g clip-path="url(#cs_clip_1_star-8)">
                    <mask id="cs_mask_1_star-8" style="mask-type:alpha" width="200" height="200" x="0" y="0" maskUnits="userSpaceOnUse">
                        <path fill="#fff" d="M100 0c12.424 62.382 37.256 87.456 100 100-62.759 12.544-87.591 37.618-100 100-12.424-62.382-37.256-87.471-100-100C62.758 87.456 87.591 62.382 100 0z"></path>
                    </mask>
                    <g mask="url(#cs_mask_1_star-8)">
                        <path fill="#fff" d="M200 0H0v200h200V0z"></path>
                        <path fill="url(#paint0_linear_star-8)" fill-opacity="0.3" d="M200 0H0v200h200V0z"></path>
                        <g filter="url(#filter0_f_748_star-8)">
                            <path fill="#06F" fill-opacity="0.2" d="M213 69H93v141h120V69z"></path>
                        </g>
                    </g>
                </g>
                <defs>
                    <filter id="filter0_f_748_star-8" width="245" height="266" x="30.5" y="6.5" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                        <feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                        <feGaussianBlur result="effect1_foregroundBlur_748_star-8" stdDeviation="31.25"></feGaussianBlur>
                    </filter>
                    <linearGradient id="paint0_linear_star-8" x1="162" x2="49.5" y1="38" y2="150.5" gradientUnits="userSpaceOnUse">
                        <stop stop-color="rgb(219,234,254)" stop-opacity="0.3"></stop>
                        <stop offset="0.5" stop-color="rgb(255,237,213)" stop-opacity="0.2"></stop>
                        <stop offset="1" stop-color="rgb(219,234,254)" stop-opacity="0.3"></stop>
                    </linearGradient>
                    <clipPath id="cs_clip_1_star-8">
                        <path fill="#fff" d="M0 0H200V200H0z"></path>
                    </clipPath>
                </defs>
            </svg>
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
        <div class="max-w-screen flex flex-col md:flex-row items-center justify-between px-4 md:px-20 py-20 bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90%">
            <div class="w-full md:w-1/4 flex flex-col items-center gap-4 mb-8 md:mb-0">
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="max-h-[45px]">
                <h2 class="text-xl font-bold italic">
                    {{ env('APP_NAME') }}
                </h2>
                <p class="text-slate-700 tracking-wide text-center md:text-left">
                    {{ $footerData['description'] }}
                </p>
            </div>
            <div class="w-full md:w-1/4 flex flex-col items-center gap-4 mb-8 md:mb-0">
                <h2 class="text-xl font-bold tracking-wide">
                    PUSAT BANTUAN
                </h2>
                <div class="flex flex-col items-center leading-relaxed">
                    @foreach($footerData['quickLinks'] as $link)
                        <a href="{{ $link['url'] }}" class="hover:text-orange-700 transition duration-700">{{ $link['title'] }}</a>
                    @endforeach
                </div>
            </div>
            <div class="w-full md:w-1/4 flex flex-col items-center gap-4 mb-8 md:mb-0">
                <h2 class="text-xl font-bold tracking-wide">
                    INFO KONTAK
                </h2>
                <div class="flex flex-col items-center leading-relaxed">
                    <a href="tel:{{ $footerData['contact']['phone'] }}" class="hover:text-orange-700 transition duration-700">{{ $footerData['contact']['phone'] }}</a>
                    <a href="mailto:{{ $footerData['contact']['email'] }}" class="hover:text-orange-700 transition duration-700">{{ $footerData['contact']['email'] }}</a>
                    <a href="https://maps.app.goo.gl/a69inXUNvLjRhbFP9" target="_blank" class="hover:text-orange-700 transition duration-700">{{ $footerData['contact']['address'] }}</a>
                </div>
            </div>
            <div class="w-full md:w-1/4 flex flex-col items-center gap-4">
                <h2 class="text-xl font-bold tracking-wide">
                    LOKASI KAMI
                </h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2847154493584!2d106.78640777490325!3d-6.228550760602384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f13094c83677%3A0x1f4300031365732b!2sUniversitas%20Pertamina!5e0!3m2!1sid!2sid!4v1699486471099!5m2!1sid!2sid"
                    class="w-full h-48 rounded-lg"
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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
