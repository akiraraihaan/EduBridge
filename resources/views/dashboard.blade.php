<x-app-layout>
    <!-- Background with blur effect -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-48 md:w-72 h-48 md:h-72 bg-[#bae8ff] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-40 right-20 w-48 md:w-72 h-48 md:h-72 bg-[#ffe9d5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-40 w-48 md:w-72 h-48 md:h-72 bg-[#ffe1c5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-lg border-b border-white/50">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-orange-500 animate-fade-in">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </header>

    <div class="py-6 sm:py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Welcome Card -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 animate-fade-in-up">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-600 to-blue-400 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Selamat Datang!</h3>
                            <p class="text-sm text-slate-600">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 animate-fade-in-up animation-delay-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-400 to-orange-300 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Statistik</h3>
                            <p class="text-sm text-slate-600">Lihat progress Anda</p>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-white/50 rounded-xl p-4">
                            <div class="text-2xl font-bold text-blue-600">12</div>
                            <div class="text-sm text-slate-600">Tugas Selesai</div>
                        </div>
                        <div class="bg-white/50 rounded-xl p-4">
                            <div class="text-2xl font-bold text-orange-500">85%</div>
                            <div class="text-sm text-slate-600">Progress</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 animate-fade-in-up animation-delay-400">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-400 to-blue-300 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Aksi Cepat</h3>
                            <p class="text-sm text-slate-600">Akses fitur utama</p>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button class="flex items-center justify-center space-x-2 bg-white/50 rounded-xl p-4 hover:bg-white/80 transition-all duration-200">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-sm font-medium text-slate-700">Kursus</span>
                        </button>
                        <button class="flex items-center justify-center space-x-2 bg-white/50 rounded-xl p-4 hover:bg-white/80 transition-all duration-200">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <span class="text-sm font-medium text-slate-700">Tugas</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8">
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 animate-fade-in-up animation-delay-600">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h3>
                        <button class="text-sm text-blue-600 hover:text-blue-700 transition-colors duration-200">Lihat Semua</button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-xl">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900">Tugas Web Development selesai</p>
                                <p class="text-xs text-slate-600">2 jam yang lalu</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-xl">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900">Melihat materi UI/UX Design</p>
                                <p class="text-xs text-slate-600">5 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        .animation-delay-200 {
            animation-delay: 0.2s;
        }
        .animation-delay-400 {
            animation-delay: 0.4s;
        }
        .animation-delay-600 {
            animation-delay: 0.6s;
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

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }
    </style>
</x-app-layout>
