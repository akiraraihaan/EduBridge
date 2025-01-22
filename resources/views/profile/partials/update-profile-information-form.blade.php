@php
use Illuminate\Support\Facades\Storage;
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form untuk menghapus foto -->
    <form id="remove-photo-form" action="{{ route('profile.remove-photo') }}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_image" :value="__('Foto Profil')" />

            <div class="mt-2 flex items-center gap-x-3">
                @if ($user->profile_image && Storage::disk('public')->exists('avatars/' . $user->profile_image))
                    <div class="relative" id="current-photo">
                        <img src="{{ asset('storage/avatars/' . $user->profile_image) }}"
                             alt="Profile"
                             class="h-12 w-12 rounded-full object-cover"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center\'><span class=\'text-orange-600 text-lg font-medium\'>{{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}</span></div>';">
                        <button type="button"
                                onclick="if(confirm('Apakah Anda yakin ingin menghapus foto profil?')) { document.getElementById('remove-photo-form').submit(); return false; }"
                                class="absolute -top-2 -right-2 bg-red-100 rounded-full p-1 text-red-600 hover:text-red-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @else
                    <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center" id="current-photo">
                        <span class="text-orange-600 text-lg font-medium">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </span>
                    </div>
                @endif

                <!-- Preview container -->
                <div id="preview-container" class="relative hidden">
                    <img id="preview-image"
                         class="h-12 w-12 rounded-full object-cover"
                         alt="Preview">
                    <button type="button"
                            onclick="cancelPreview()"
                            class="absolute -top-2 -right-2 bg-red-100 rounded-full p-1 text-red-600 hover:text-red-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <input type="file"
                       id="profile_image"
                       name="profile_image"
                       accept="image/*"
                       onchange="previewImage(this)"
                       class="rounded-md bg-white/50 border-gray-300 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            </div>

            @if (session('status') === 'photo-removed')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="mt-2 text-sm text-green-600"
                >{{ __('Foto profil berhasil dihapus.') }}</p>
            @endif

            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview-image');
                const previewContainer = document.getElementById('preview-container');
                const currentPhoto = document.getElementById('current-photo');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        currentPhoto.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                    }

                    reader.onerror = function() {
                        alert('Error membaca file. Silakan coba file lain.');
                        cancelPreview();
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function cancelPreview() {
                const input = document.getElementById('profile_image');
                const previewContainer = document.getElementById('preview-container');
                const currentPhoto = document.getElementById('current-photo');

                input.value = ''; // Reset input file
                previewContainer.classList.add('hidden');
                currentPhoto.classList.remove('hidden');
            }
        </script>

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('Nama Depan')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('Nama Belakang')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- WhatsApp -->
        <div>
            <x-input-label for="whatsapp" :value="__('WhatsApp')" />
            <x-text-input id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full" :value="old('whatsapp', $user->whatsapp)" required />
            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 bg-white/50" placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
