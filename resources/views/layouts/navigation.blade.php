<nav x-data="{ open: false }" class="bg-slate-100 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    @if (Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.batches.index')" :active="request()->routeIs('admin.batches.*')">
                            {{ __('Kelola Batch') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.mentors.index')" :active="request()->routeIs('admin.mentors.*')">
                            {{ __('Kelola Mentor') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                            {{ __('Kelola Siswa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.certificates.index')" :active="request()->routeIs('admin.certificates.*')">
                            {{ __('Distribusi Sertifikat') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.top-performers.index')" :active="request()->routeIs('admin.top-performers.*')">
                            <span class="italic">{{ __('Top Performers') }}</span>
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->isMentor())
                        <x-nav-link :href="route('mentor.dashboard')" :active="request()->routeIs('mentor.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mentor.modules.index')" :active="request()->routeIs('mentor.modules.*')">
                            {{ __('Modul') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mentor.materials.index')" :active="request()->routeIs('mentor.materials.*')">
                            {{ __('Materi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mentor.assignments.index')" :active="request()->routeIs('mentor.assignments.*')">
                            {{ __('Tugas') }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->isStudent())
                        <x-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                    @if(auth()->user()->hasRole('student'))
                        <x-nav-link :href="route('student.materials.index')" :active="request()->routeIs('student.materials.*')">
                            {{ __('Materi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.*')">
                            {{ __('Tugas') }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->role_id === 2 || Auth::user()->role_id === 3)
                        <x-nav-link :href="route('certificates.index')" :active="request()->routeIs('certificates.*')">
                            {{ __('Sertifikat Saya') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                @if(Auth::user()->profile_image && Storage::disk('public')->exists('avatars/' . Auth::user()->profile_image))
                                    <img src="{{ asset('storage/avatars/' . Auth::user()->profile_image) }}"
                                         alt="Profile"
                                         class="h-8 w-8 rounded-full object-cover mr-2">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center mr-2">
                                        <span class="text-orange-600 text-xs font-medium">
                                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <span>{{ Auth::user()->first_name }}</span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-500">
                            @if(Auth::user()->isAdmin())
                                <span>Administrator</span>
                            @elseif(Auth::user()->isMentor())
                                <span>Mentor</span>
                                <div class="mt-1">
                                    @foreach(Auth::user()->mentorCourses as $mentorCourse)
                                        <span class="block text-gray-600">{{ $mentorCourse->course->name }}</span>
                                    @endforeach
                                </div>
                            @elseif(Auth::user()->isStudent())
                                <span>Siswa</span>
                                @if(Auth::user()->course)
                                    <span class="block text-gray-600">{{ Auth::user()->course->name }}</span>
                                @endif
                            @endif
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Pengaturan Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            @if (Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.top-performers.index')" :active="request()->routeIs('admin.top-performers.*')">
                    {{ __('Top Performers') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.batches.index')" :active="request()->routeIs('admin.batches.*')">
                    {{ __('Batch') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.mentors.index')" :active="request()->routeIs('admin.mentors.*')">
                    {{ __('Mentor') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                    {{ __('Siswa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.certificates.index')" :active="request()->routeIs('admin.certificates.*')">
                    {{ __('Sertifikat') }}
                </x-responsive-nav-link>
            @endif
            @if (Auth::user()->isMentor())
                <x-responsive-nav-link :href="route('mentor.dashboard')" :active="request()->routeIs('mentor.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mentor.modules.index')" :active="request()->routeIs('mentor.modules.*')">
                    {{ __('Modul') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mentor.materials.index')" :active="request()->routeIs('mentor.materials.*')">
                    {{ __('Materi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mentor.assignments.index')" :active="request()->routeIs('mentor.assignments.*')">
                    {{ __('Tugas') }}
                </x-responsive-nav-link>
            @endif
            @if (Auth::user()->isStudent())
                <x-responsive-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.materials.index')" :active="request()->routeIs('student.materials.*')">
                    {{ __('Materi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.*')">
                    {{ __('Tugas') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="flex items-center">
                    @if(Auth::user()->profile_image && Storage::disk('public')->exists('avatars/' . Auth::user()->profile_image))
                        <img src="{{ asset('storage/avatars/' . Auth::user()->profile_image) }}"
                             alt="Profile"
                             class="h-8 w-8 rounded-full object-cover mr-2">
                    @else
                        <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center mr-2">
                            <span class="text-orange-600 text-xs font-medium">
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <span>{{ Auth::user()->first_name }}</span>
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <div class="mt-1 text-xs text-gray-500">
                    @if(Auth::user()->isAdmin())
                        <span>Administrator</span>
                    @elseif(Auth::user()->isMentor())
                        <span>Mentor</span>
                        <div class="mt-1">
                            @foreach(Auth::user()->mentorCourses as $mentorCourse)
                                <span class="block text-gray-600">{{ $mentorCourse->course->name }}</span>
                            @endforeach
                        </div>
                    @elseif(Auth::user()->isStudent())
                        <span>Siswa</span>
                        @if(Auth::user()->course)
                            <span class="block text-gray-600">{{ Auth::user()->course->name }}</span>
                        @endif
                    @endif
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Pengaturan Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
