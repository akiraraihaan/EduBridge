<x-guest-layout>
    <!-- Background with blur effect -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-48 md:w-72 h-48 md:h-72 bg-[#bae8ff] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-40 right-20 w-48 md:w-72 h-48 md:h-72 bg-[#ffe9d5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-40 w-48 md:w-72 h-48 md:h-72 bg-[#ffe1c5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="min-h-screen py-6 sm:py-8 md:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto space-y-4 sm:space-y-6 md:space-y-8">
            <!-- Header -->
            <div class="text-center animate-fade-in">
                <a href="{{ url('/') }}" class="inline-flex items-center mb-4 sm:mb-6 md:mb-8 text-xs sm:text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="h-8 sm:h-10 md:h-12 mx-auto mb-3 sm:mb-4 animate-fade-in-up opacity-70">
                <p class="text-base sm:text-lg md:text-xl font-medium text-slate-700 mb-3 sm:mb-4 text-center animate-fade-in-up animation-delay-400">Masuk</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white/40 backdrop-blur-lg rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 shadow-xl border border-white/50 animate-fade-in-up animation-delay-600">
                <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
                    @csrf

                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: '{{ session('success') }}',
                                    confirmButtonColor: '#3085d6',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                });
                            });
                        </script>
                    @endif

                    @if (session('status'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Info',
                                    text: '{{ session('status') }}',
                                    confirmButtonColor: '#3085d6',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                });
                            });
                        </script>
                    @endif

                    <div class="space-y-1 sm:space-y-2">
                        <x-input-label for="email" :value="__('Email')" class="text-sm sm:text-base" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center z-10">
                                <svg class="h-5 w-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email" class="block w-full pl-10 text-sm sm:text-base relative z-0" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs sm:text-sm" />
                    </div>

                    <div class="space-y-1 sm:space-y-2">
                        <x-input-label for="password" :value="__('Password')" class="text-sm sm:text-base" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center z-10">
                                <svg class="h-5 w-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password" class="block w-full pl-10 text-sm sm:text-base" type="password" name="password" required autocomplete="current-password" placeholder="" />
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eye-icon" class="h-5 w-5 text-slate-400 hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs sm:text-sm" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500" name="remember">
                            <span class="ms-2 text-xs sm:text-sm text-slate-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-xs sm:text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-end pt-4 sm:pt-6">
                        <a class="text-xs sm:text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200" href="{{ route('register') }}">
                            {{ __('Belum punya akun?') }}
                        </a>

                        <button type="submit" id="submit-btn" class="ml-3 sm:ml-4 relative px-5 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-blue-600 to-blue-400 rounded-xl font-medium text-sm sm:text-base text-white hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 ease-in-out">
                            <span id="btn-text">{{ __('Masuk') }}</span>
                            <span id="btn-loader" class="absolute inset-0 items-center justify-center hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Social Proof -->
            {{-- <div class="text-center space-y-3 animate-fade-in-up animation-delay-800">
                <p class="text-xs sm:text-sm text-slate-500">Dipercaya oleh ratusan siswa dan mentor</p>
                <div class="flex justify-center space-x-6">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-400"></div>
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-orange-400 to-orange-300"></div>
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-400 to-blue-300"></div>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center bg-white/80 backdrop-blur-sm text-xs font-medium text-slate-600">500+</div>
                    </div>
                </div>
            </div> --}}
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
        .animation-delay-800 {
            animation-delay: 0.8s;
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

        /* Custom form styling */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            @apply bg-white/50 backdrop-blur-sm border-white/50 rounded-lg sm:rounded-xl shadow-sm transition-all duration-200;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            @apply ring-2 ring-blue-200 ring-offset-0 border-blue-300 shadow-blue-100/50;
        }

        /* Custom checkbox styling */
        input[type="checkbox"] {
            @apply rounded-md border-white/50 text-blue-500 shadow-sm transition-all duration-200;
        }
        input[type="checkbox"]:focus {
            @apply ring-2 ring-blue-200 ring-offset-0 border-blue-300;
        }
    </style>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                password.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnLoader = document.getElementById('btn-loader');

            submitBtn.disabled = true;
            btnText.classList.add('invisible');
            btnLoader.classList.remove('hidden');
            btnLoader.classList.add('flex');
        });
    </script>
</x-guest-layout>
