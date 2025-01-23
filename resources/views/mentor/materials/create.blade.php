<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Materi Baru') }}
            </h2>
            <div class="text-sm text-gray-600">
                Anda adalah mentor untuk kursus:
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $course->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/50 backdrop-blur-sm shadow-md overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mentor.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="module_id" :value="__('Modul')" />
                            <select id="module_id" name="module_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Modul</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                                        {{ $module->title }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Pilih modul tempat materi ini akan ditambahkan</p>
                            <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Judul Materi')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                            <p class="mt-1 text-sm text-gray-500">Berikan judul yang deskriptif untuk materi ini</p>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="content" :value="__('Deskripsi')" />
                            <textarea id="content" name="content" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Jelaskan secara singkat tentang isi dan tujuan materi ini</p>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="border rounded-lg p-4 bg-gray-50">
                            <x-input-label for="file" :value="__('File PDF (Opsional)')" />
                            <input type="file" id="file" name="file" class="mt-1 block w-full text-sm text-gray-500" accept=".pdf" onchange="previewPDF(this)">
                            <iframe id="pdf-preview" class="mt-2" style="display:none; width:100%; height:200px;"></iframe>
                            <p class="mt-1 text-sm text-gray-500">Unggah file PDF (maksimal 10MB)</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="border rounded-lg p-4 bg-gray-50">
                            <x-input-label for="video_url" :value="__('URL Video YouTube (Opsional)')" />
                            <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-full" :value="old('video_url')" placeholder="https://www.youtube.com/watch?v=..." />
                            <p class="mt-1 text-sm text-gray-500">Masukkan URL video YouTube (contoh: https://www.youtube.com/watch?v=xxxxx)</p>
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="order" :value="__('Urutan dalam Modul')" />
                            <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order')" required min="1" />
                            <p class="mt-1 text-sm text-gray-500">Urutan penampilan materi dalam modul (1 = pertama, 2 = kedua, dst)</p>
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('mentor.materials.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function previewPDF(input) {
        const file = input.files[0];
        if (file && file.type === "application/pdf") {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('pdf-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
    </script>
</x-app-layout>

