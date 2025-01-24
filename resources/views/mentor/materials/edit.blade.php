<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Materi') }}
            </h2>
            <div class="text-sm text-gray-600">
                Anda adalah mentor untuk kursus:
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $material->module->course->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/50 backdrop-blur-sm shadow-sm overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mentor.materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="module_id" class="block text-sm font-medium text-gray-700 mb-1">Modul</label>
                            <select id="module_id" name="module_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="">Pilih Modul</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ old('module_id', $material->module_id) == $module->id ? 'selected' : '' }}>
                                        {{ $module->title }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Pilih modul tempat materi ini akan ditambahkan</p>
                            <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                            <input type="text" id="title" name="title" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('title', $material->title) }}" required>
                            <p class="mt-1 text-sm text-gray-500">Berikan judul yang deskriptif untuk materi ini</p>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea id="content" name="content" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('content', $material->content) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Jelaskan secara singkat tentang isi dan tujuan materi ini</p>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="border rounded-lg p-4 bg-blue-50">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File PDF (Opsional)</label>
                            @if($material->file_path)
                                <div class="mb-2">
                                    <p class="text-sm text-gray-600">File PDF saat ini: {{ basename($material->file_path) }}</p>
                                </div>
                            @endif
                            <input type="file" id="file" name="file" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm text-gray-500" accept=".pdf" onchange="previewPDF(this)">
                            <iframe id="pdf-preview" class="mt-2" style="display:none; width:100%; height:200px;"></iframe>
                            <p class="mt-1 text-sm text-gray-500">Unggah file PDF baru (maksimal 10MB) atau biarkan kosong untuk mempertahankan file yang ada</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="border rounded-lg p-4 bg-blue-50">
                            <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">URL Video YouTube (Opsional)</label>
                            <input type="url" id="video_url" name="video_url" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('video_url', $material->video_id ? 'https://www.youtube.com/watch?v=' . $material->video_id : '') }}" placeholder="https://www.youtube.com/watch?v=...">
                            <p class="mt-1 text-sm text-gray-500">Masukkan URL video YouTube (contoh: https://www.youtube.com/watch?v=xxxxx)</p>
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan dalam Modul</label>
                            <input type="number" id="order" name="order" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('order', $material->order) }}" required min="1">
                            <p class="mt-1 text-sm text-gray-500">Urutan penampilan materi dalam modul (1 = pertama, 2 = kedua, dst)</p>
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-lg font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                                {{ __('Simpan Perubahan') }}
                            </button>
                            <a href="{{ route('mentor.materials.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
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
