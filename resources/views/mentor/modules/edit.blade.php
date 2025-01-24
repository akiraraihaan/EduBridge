<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Modul') }}
            </h2>
            <div class="text-sm text-gray-600">
                Anda adalah mentor untuk kursus:
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $module->course->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/50 backdrop-blur-sm shadow-sm overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mentor.modules.update', $module) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Modul</label>
                            <input type="text" id="title" name="title" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('title', $module->title) }}" required>
                            <p class="mt-1 text-sm text-gray-500">Berikan judul yang deskriptif untuk modul ini</p>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea id="description" name="description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('description', $module->description) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Jelaskan secara singkat tentang isi dan tujuan modul ini</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan dalam Kursus</label>
                            <input type="number" id="order" name="order" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('order', $module->order) }}" required min="1">
                            <p class="mt-1 text-sm text-gray-500">Urutan penampilan modul dalam kursus (1 = pertama, 2 = kedua, dst)</p>
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="draft" {{ old('status', $module->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $module->status) == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Draft: hanya dapat dilihat oleh mentor, Dipublikasi: dapat dilihat oleh siswa</p>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-lg font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                                {{ __('Simpan Perubahan') }}
                            </button>
                            <a href="{{ route('mentor.modules.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

