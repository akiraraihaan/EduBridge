<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Modul') }}
            </h2>
            <div class="text-sm text-gray-600">
                Anda adalah mentor untuk kursus:
                @foreach(Auth::user()->mentorCourses as $mentorCourse)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $mentorCourse->course->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mentor.modules.update', $module) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="course_id" :value="__('Kursus')" />
                            <select id="course_id" name="course_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Pilih Kursus</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id', $module->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Pilih kursus tempat modul ini akan ditambahkan</p>
                            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Judul Modul')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $module->title)" required />
                            <p class="mt-1 text-sm text-gray-500">Berikan judul yang deskriptif untuk modul ini</p>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $module->description) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Jelaskan secara singkat tentang isi dan tujuan modul ini</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="order" :value="__('Urutan dalam Kursus')" />
                            <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', $module->order)" required min="1" />
                            <p class="mt-1 text-sm text-gray-500">Urutan penampilan modul dalam kursus (1 = pertama, 2 = kedua, dst)</p>
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="draft" {{ old('status', $module->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $module->status) == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Draft: hanya dapat dilihat oleh mentor, Dipublikasi: dapat dilihat oleh siswa</p>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('mentor.modules.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
