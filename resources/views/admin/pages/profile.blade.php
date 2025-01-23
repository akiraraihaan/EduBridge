<x-app-final-layout>
    <div class="min-h-screen bg-white/20">
        <!-- Welcome Banner -->
        <div class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Profile Admin</h1>
                        <p class="mt-1 text-sm text-gray-500">Kelola informasi profil Anda</p>
                    </div>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-800 focus:outline-none focus:border-orange-800 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 space-y-6">
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            @if(Auth::user()->profile_image)
                                <img class="h-24 w-24 rounded-full object-cover" src="{{ asset('storage/avatars/' . Auth::user()->profile_image) }}" alt="Profile photo">
                            @else
                                <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-2xl text-gray-500">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <dl class="divide-y divide-gray-200">
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Role</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Admin</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">WhatsApp</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->whatsapp ?? '-' }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->birth_date ? Auth::user()->birth_date->format('d F Y') : '-' }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Bio</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->bio ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-final-layout>
