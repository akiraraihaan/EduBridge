<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Tugas Baru') }}
            </h2>
            <div class="text-sm text-gray-600 mt-1">
                Anda adalah mentor untuk kursus:
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $modules->first()->course->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/50 backdrop-blur-sm shadow-sm overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('mentor.assignments.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="module_id" class="block text-sm font-medium text-gray-700 mb-1">Modul</label>
                            <select id="module_id" name="module_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="">Pilih Modul</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                                        {{ $module->title }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Pilih modul tempat tugas ini akan ditambahkan</p>
                            <x-input-error :messages="$errors->get('module_id')" class="mt-2" />
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas</label>
                            <input type="text" id="title" name="title" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('title') }}" required>
                            <p class="mt-1 text-sm text-gray-500">Berikan judul yang deskriptif untuk tugas ini</p>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea id="description" name="description" rows="4" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>{{ old('description') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Jelaskan secara detail tentang tugas yang harus dikerjakan</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Tenggat Waktu</label>
                            <input type="date" id="due_date" name="due_date" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('due_date') }}" required>
                            <p class="mt-1 text-sm text-gray-500">Tentukan batas waktu pengumpulan tugas</p>
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <div>
                            <label for="max_score" class="block text-sm font-medium text-gray-700 mb-1">Nilai Maksimal</label>
                            <input type="number" id="max_score" name="max_score" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('max_score', 100) }}" min="0" max="100" required>
                            <p class="mt-1 text-sm text-gray-500">Tentukan nilai maksimal untuk tugas ini (0-100)</p>
                            <x-input-error :messages="$errors->get('max_score')" class="mt-2" />
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Pilih status publikasi tugas</p>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-lg font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                                {{ __('Simpan') }}
                            </button>
                            <a href="{{ route('mentor.assignments.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
