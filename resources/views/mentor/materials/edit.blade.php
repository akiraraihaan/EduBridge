<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Materi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mentor.materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="module_id" :value="__('Modul')" />
                            <select id="module_id" name="module_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Pilih Modul</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ old('module_id', $material->module_id) == $module->id ? 'selected' : '' }}>
                                        {{ $module->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Judul Materi')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $material->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="content" :value="__('Deskripsi')" />
                            <textarea id="content" name="content" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content', $material->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="type" :value="__('Tipe Materi')" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" onchange="toggleMaterialType()">
                                <option value="">Pilih Tipe</option>
                                <option value="pdf" {{ old('type', $material->type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="video" {{ old('type', $material->type) == 'video' ? 'selected' : '' }}>Video YouTube</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div id="pdf-upload" style="display: none;">
                            <x-input-label for="file" :value="__('Upload PDF')" />
                            @if($material->type === 'pdf' && $material->file_path)
                                <div class="mb-2">
                                    <span class="text-sm text-gray-600">File saat ini: </span>
                                    <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        {{ basename($material->file_path) }}
                                    </a>
                                </div>
                            @endif
                            <input type="file" id="file" name="file" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" />
                            <p class="mt-1 text-sm text-gray-500">PDF maksimal 10MB. Biarkan kosong jika tidak ingin mengubah file.</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div id="video-input" style="display: none;">
                            <x-input-label for="video_url" :value="__('URL Video YouTube')" />
                            <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-full"
                                :value="old('video_url', $material->type === 'video' ? 'https://www.youtube.com/watch?v=' . $material->file_path : '')"
                                placeholder="https://www.youtube.com/watch?v=..." />
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="order" :value="__('Urutan')" />
                            <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', $material->order)" required min="1" />
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('mentor.materials.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleMaterialType() {
            const type = document.getElementById('type').value;
            const pdfUpload = document.getElementById('pdf-upload');
            const videoInput = document.getElementById('video-input');

            if (type === 'pdf') {
                pdfUpload.style.display = 'block';
                videoInput.style.display = 'none';
            } else if (type === 'video') {
                pdfUpload.style.display = 'none';
                videoInput.style.display = 'block';
            } else {
                pdfUpload.style.display = 'none';
                videoInput.style.display = 'none';
            }
        }

        // Run on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleMaterialType();
        });
    </script>
    @endpush
</x-app-layout>
