<x-guest-layout>
    <!-- Background with blur effect -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-[#bae8ff] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-[#ffe9d5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-[#ffe1c5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto space-y-8">
            <!-- Header -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center mb-8 text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Home
                </a>
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h2>
                <p class="text-slate-600">Masuk ke akun Anda</p>
            </div>

            <!-- Role Selection -->
            <div class="bg-white/40 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-white/50">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Masuk Sebagai</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Student Button -->
                    <button type="button" onclick="selectRole('student')" id="student-btn"
                            class="role-btn p-4 rounded-xl border-2 border-transparent bg-gradient-to-r from-[#bae8ff]/50 to-[#e2f5ff]/50 backdrop-blur-sm text-slate-800 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/>
                            </svg>
                            <span class="font-medium">Student</span>
                        </div>
                    </button>

                    <!-- Mentor Button -->
                    <button type="button" onclick="selectRole('mentor')" id="mentor-btn"
                            class="role-btn p-4 rounded-xl border-2 border-transparent bg-white/50 backdrop-blur-sm text-slate-800 hover:shadow-lg hover:shadow-slate-500/30 transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <span class="font-medium">Mentor</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Login Form -->
            <div class="bg-white/40 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-white/50">
                <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="role_id" id="role_id" value="3">

                    @if (session('status'))
                        <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500" name="remember">
                            <span class="ms-2 text-sm text-slate-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-6">
                        <a class="text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200" href="{{ route('register') }}">
                            {{ __('Belum punya akun?') }}
                        </a>

                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] rounded-xl font-medium text-slate-800 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 ease-in-out">
                            {{ __('Masuk') }}
                        </button>
                    </div>
                </form>
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

        /* Custom form styling */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            @apply bg-white/50 backdrop-blur-sm border-white/50 rounded-xl shadow-sm transition-all duration-200;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            @apply ring-2 ring-orange-200 ring-offset-0 border-orange-300 shadow-orange-100/50;
        }
    </style>

    <script>
        function selectRole(role) {
            // Update hidden role_id input
            const roleId = role === 'student' ? 3 : 2;
            document.getElementById('role_id').value = roleId;

            // Update button styles
            const studentBtn = document.getElementById('student-btn');
            const mentorBtn = document.getElementById('mentor-btn');

            if (role === 'student') {
                studentBtn.classList.add('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                studentBtn.classList.remove('bg-white/50');
                mentorBtn.classList.remove('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                mentorBtn.classList.add('bg-white/50');
            } else {
                mentorBtn.classList.add('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                mentorBtn.classList.remove('bg-white/50');
                studentBtn.classList.remove('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                studentBtn.classList.add('bg-white/50');
            }
        }

        // Set initial role
        document.addEventListener('DOMContentLoaded', () => {
            selectRole('student');
        });
    </script>
</x-guest-layout>
