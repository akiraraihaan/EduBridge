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

    <div class="min-h-screen py-6 sm:py-8 md:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl mx-auto space-y-4 sm:space-y-6 md:space-y-8">
            <!-- Header -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center mb-4 sm:mb-6 md:mb-8 text-xs sm:text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="h-8 sm:h-10 md:h-12 mx-auto mb-3 sm:mb-4 opacity-70">
            </div>

            <!-- Role Selection -->
            <div class="bg-white/40 backdrop-blur-lg rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 shadow-xl border border-white/50">
                <h3 class="text-base sm:text-lg md:text-xl font-medium text-slate-700 mb-3 sm:mb-4 text-center">Daftar sebagai</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Student Button -->
                    <button type="button" onclick="selectRole('student')" id="student-btn"
                            class="role-btn p-3 sm:p-4 rounded-lg sm:rounded-xl border-2 border-transparent bg-gradient-to-r from-[#bae8ff]/50 to-[#e2f5ff]/50 backdrop-blur-sm text-slate-800 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-center">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 mb-1 sm:mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/>
                            </svg>
                            <span class="text-sm sm:text-base font-medium">Student</span>
                            <span class="text-xs sm:text-sm text-slate-600">Pelajari skill baru</span>
                        </div>
                    </button>

                    <!-- Mentor Button -->
                    <button type="button" onclick="selectRole('mentor')" id="mentor-btn"
                            class="role-btn p-3 sm:p-4 rounded-lg sm:rounded-xl border-2 border-transparent bg-white/50 backdrop-blur-sm text-slate-800 hover:shadow-lg hover:shadow-slate-500/30 transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-center">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 mb-1 sm:mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <span class="text-sm sm:text-base font-medium">Mentor</span>
                            <span class="text-xs sm:text-sm text-slate-600">Bagikan pengetahuan</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="bg-white/40 backdrop-blur-lg rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 shadow-xl border border-white/50">
                <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-6">
                    @csrf
                    <input type="hidden" name="role_id" id="role_id" value="3">

                    <!-- Common Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="first_name" :value="__('Nama Depan')" class="text-sm sm:text-base" />
                            <x-text-input id="first_name" class="block mt-1 w-full text-sm sm:text-base" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-xs sm:text-sm" />
                        </div>

                        <div>
                            <x-input-label for="last_name" :value="__('Nama Belakang')" class="text-sm sm:text-base" />
                            <x-text-input id="last_name" class="block mt-1 w-full text-sm sm:text-base" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-xs sm:text-sm" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="birth_date" :value="__('Tanggal Lahir')" class="text-sm sm:text-base" />
                        <x-text-input id="birth_date" class="block mt-1 w-full text-sm sm:text-base" type="date" name="birth_date" :value="old('birth_date')" required onchange="validateAge()" />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-2 text-xs sm:text-sm" />
                        <p id="age-error" class="mt-2 text-sm text-red-600 hidden"></p>
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm sm:text-base" />
                        <x-text-input id="email" class="block mt-1 w-full text-sm sm:text-base" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs sm:text-sm" />
                    </div>

                    <div>
                        <x-input-label for="whatsapp" :value="__('Nomor WhatsApp')" class="text-sm sm:text-base" />
                        <x-text-input id="whatsapp" class="block mt-1 w-full text-sm sm:text-base" type="tel" name="whatsapp" :value="old('whatsapp')" required placeholder="62" />
                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2 text-xs sm:text-sm" />
                    </div>

                    <!-- Student Fields -->
                    <div id="student-fields" class="space-y-6">
                        <div>
                            <x-input-label for="course_id" :value="__('Pilih Kursus')" class="text-sm sm:text-base" />
                            <select id="course_id" name="course_id" class="w-full px-4 py-3 bg-white/70 backdrop-blur-md border-0 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02),0_1px_6px_rgba(0,0,0,0.03)] transition duration-200 ease-in-out text-slate-600 placeholder:text-slate-400 hover:bg-white/90 hover:shadow-[0_2px_8px_rgba(0,0,0,0.05),0_2px_4px_rgba(0,0,0,0.03)] focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-100/50 disabled:opacity-50 disabled:cursor-not-allowed" required>
                                <option value="" disabled selected>Pilih Kursus</option>
                                @foreach(\App\Models\Course::all() as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('course_id')" class="mt-2 text-xs sm:text-sm" />
                        </div>

                        <div>
                            <x-input-label for="profession" :value="__('Profesi Saat Ini')" class="text-sm sm:text-base" />
                            <x-text-input id="profession" class="block mt-1 w-full text-sm sm:text-base" type="text" name="profession" :value="old('profession')" />
                            <x-input-error :messages="$errors->get('profession')" class="mt-2 text-xs sm:text-sm" />
                        </div>

                        <div>
                            <x-input-label for="reason" :value="__('Alasan Mengambil Kursus')" class="text-sm sm:text-base" />
                            <textarea id="reason" name="reason" rows="3" class="w-full px-4 py-3 bg-white/70 backdrop-blur-md border-0 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02),0_1px_6px_rgba(0,0,0,0.03)] transition duration-200 ease-in-out text-slate-600 placeholder:text-slate-400 hover:bg-white/90 hover:shadow-[0_2px_8px_rgba(0,0,0,0.05),0_2px_4px_rgba(0,0,0,0.03)] focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-100/50 disabled:opacity-50 disabled:cursor-not-allowed">{{ old('reason') }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2 text-xs sm:text-sm" />
                        </div>
                    </div>

                    <!-- Mentor Fields -->
                    <div id="mentor-fields" class="space-y-6 hidden">
                        <div>
                            <x-input-label for="education_background" :value="__('Latar Belakang Pendidikan')" class="text-sm sm:text-base" />
                            <textarea id="education_background" name="education_background" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('education_background') }}</textarea>
                            <x-input-error :messages="$errors->get('education_background')" class="mt-2 text-xs sm:text-sm" />
                        </div>

                        <div>
                            <x-input-label for="certifications_file" :value="__('Upload Sertifikasi (PDF, max 2MB)')" class="text-sm sm:text-base" />
                            <input type="file" id="certifications_file" name="certifications_file" accept=".pdf" class="block w-full text-sm text-slate-500 mt-1
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-orange-50 file:text-orange-700
                                hover:file:bg-orange-100
                                cursor-pointer
                            "/>
                            <x-input-error :messages="$errors->get('certifications_file')" class="mt-2 text-xs sm:text-sm" />
                        </div>

                        <div>
                            <x-input-label for="preferred_course" :value="__('Kursus yang Ingin Diajar')" class="text-sm sm:text-base" />
                            <select id="preferred_course" name="preferred_course" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Kursus</option>
                                @foreach(\App\Models\Course::all() as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('preferred_course')" class="mt-2 text-xs sm:text-sm" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-sm sm:text-base" />
                            <div class="relative">
                                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="new-password" />
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 flex items-center px-3 mt-1 text-gray-500 hover:text-gray-700">
                                    <svg id="password-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs sm:text-sm" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-sm sm:text-base" />
                            <div class="relative">
                                <x-text-input id="password_confirmation"
                                    class="block mt-1 w-full pr-10"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    oninput="validatePassword()" />
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 flex items-center px-3 mt-1 text-gray-500 hover:text-gray-700">
                                    <svg id="password_confirmation-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <p id="password-match-error" class="mt-2 text-sm text-red-600 hidden">Password tidak cocok</p>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs sm:text-sm" />
                            <script>
                                function validatePassword() {
                                    const password = document.getElementById('password').value;
                                    const confirmation = document.getElementById('password_confirmation').value;
                                    const errorElement = document.getElementById('password-match-error');

                                    if(confirmation && password !== confirmation) {
                                        errorElement.classList.remove('hidden');
                                    } else {
                                        errorElement.classList.add('hidden');
                                    }
                                }
                            </script>
                        </div>
                    </div>

                    <script>
                        function togglePassword(fieldId) {
                            const field = document.getElementById(fieldId);
                            const icon = document.getElementById(fieldId + '-icon');

                            if (field.type === 'password') {
                                field.type = 'text';
                                icon.innerHTML = `
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                `;
                            } else {
                                field.type = 'password';
                                icon.innerHTML = `
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                `;
                            }
                        }
                    </script>

                    <div class="flex items-center justify-end mt-6">
                        <a class="text-xs sm:text-sm text-slate-600 hover:text-slate-900 transition-colors duration-200" href="{{ route('login') }}">
                            {{ __('Sudah punya akun?') }}
                        </a>

                        <button type="submit" class="ml-3 sm:ml-4 px-4 sm:px-6 py-2 sm:py-2.5 text-sm sm:text-base bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] rounded-lg sm:rounded-xl font-medium text-slate-800 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 ease-in-out">
                            {{ __('Daftar') }}
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

        /* Responsive text sizes */
        @media (max-width: 640px) {
            .text-responsive {
                font-size: 0.875rem;
            }
            .input-responsive {
                font-size: 0.875rem;
                padding: 0.5rem 0.75rem;
            }
        }

        @media (min-width: 641px) {
            .text-responsive {
                font-size: 1rem;
            }
            .input-responsive {
                font-size: 1rem;
                padding: 0.625rem 1rem;
            }
        }

        /* Custom form styling */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        select,
        textarea {
            @apply bg-white/50 backdrop-blur-sm border-white/50 rounded-lg sm:rounded-xl shadow-sm transition-all duration-200 text-sm sm:text-base;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus,
        select:focus,
        textarea:focus {
            @apply ring-2 ring-orange-200 ring-offset-0 border-orange-300 shadow-orange-100/50;
        }

        select {
            @apply appearance-none bg-no-repeat bg-right pr-8 sm:pr-10;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
        }
    </style>

    <script>
        function calculateAge(birthDate) {
            const today = new Date();
            const birth = new Date(birthDate);
            let age = today.getFullYear() - birth.getFullYear();
            const monthDiff = today.getMonth() - birth.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                age--;
            }

            return age;
        }

        function validateAge() {
            const birthDateInput = document.getElementById('birth_date');
            const errorElement = document.getElementById('age-error');
            const roleId = document.getElementById('role_id').value;
            const age = calculateAge(birthDateInput.value);

            errorElement.classList.add('hidden');
            birthDateInput.setCustomValidity('');

            if (roleId == 3) { // Student
                if (age < 17 || age > 30) {
                    errorElement.textContent = 'Usia untuk student harus antara 17-30 tahun.';
                    errorElement.classList.remove('hidden');
                    birthDateInput.setCustomValidity('Invalid age');
                }
            } else if (roleId == 2) { // Mentor
                if (age < 17) {
                    errorElement.textContent = 'Usia untuk mentor minimal 17 tahun.';
                    errorElement.classList.remove('hidden');
                    birthDateInput.setCustomValidity('Invalid age');
                }
            }
        }

        function selectRole(role) {
            // Update hidden role_id input
            const roleId = role === 'student' ? 3 : 2;
            document.getElementById('role_id').value = roleId;

            // Validate age for new role
            validateAge();

            // Update button styles
            const studentBtn = document.getElementById('student-btn');
            const mentorBtn = document.getElementById('mentor-btn');
            const studentFields = document.getElementById('student-fields');
            const mentorFields = document.getElementById('mentor-fields');

            if (role === 'student') {
                studentBtn.classList.add('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                studentBtn.classList.remove('bg-white/50');
                mentorBtn.classList.remove('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                mentorBtn.classList.add('bg-white/50');
                studentFields.classList.remove('hidden');
                mentorFields.classList.add('hidden');
            } else {
                mentorBtn.classList.add('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                mentorBtn.classList.remove('bg-white/50');
                studentBtn.classList.remove('bg-gradient-to-r', 'from-[#bae8ff]/50', 'to-[#e2f5ff]/50');
                studentBtn.classList.add('bg-white/50');
                mentorFields.classList.remove('hidden');
                studentFields.classList.add('hidden');
            }
        }

        // Set initial role
        document.addEventListener('DOMContentLoaded', () => {
            selectRole('student');
        });
    </script>
</x-guest-layout>
