<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Detail Tugas -->
            <div class="bg-white/50 backdrop-blur-sm overflow-hidden shadow-md sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">{{ $assignment->title }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Modul</p>
                                <p class="font-medium">{{ $assignment->module->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tenggat Waktu</p>
                                <p class="font-medium">{{ $assignment->due_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nilai Maksimal</p>
                                <p class="font-medium">{{ $assignment->max_score }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                @if($submission)
                                    @if($submission->graded_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Nilai: {{ $submission->score }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Sudah Dikumpulkan
                                        </span>
                                    @endif
                                @else
                                    @if($assignment->due_date->isPast())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Belum Dikumpulkan
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Deskripsi Tugas</h4>
                        <div class="prose max-w-none">
                            {!! nl2br(e($assignment->description)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pengumpulan -->
            <div class="bg-white/50 backdrop-blur-sm overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">
                        @if($submission)
                            Pengumpulan Tugas
                        @else
                            Kumpulkan Tugas
                        @endif
                    </h3>

                    @if($submission && $submission->graded_at)
                        <div class="bg-white/50 backdrop-blur-sm rounded-lg border border-gray-200 p-4 mb-4">
                            <h4 class="font-medium text-gray-900">Feedback dari Mentor</h4>
                            <p class="mt-2 text-gray-600">{{ $submission->feedback ?? 'Tidak ada feedback' }}</p>
                        </div>
                    @endif

                    @if(!$assignment->due_date->isPast() || $submission)
                        <form action="{{ route('student.assignments.submit', $assignment) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="content" :value="__('Jawaban')" />
                                <textarea id="content" name="content" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-md" required {{ $submission && $submission->graded_at ? 'disabled' : '' }}>{{ old('content', $submission?->content) }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="file" :value="__('File Pendukung (Opsional)')" />
                                <input type="file" id="file" name="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" {{ $submission && $submission->graded_at ? 'disabled' : '' }}>
                                <p class="mt-1 text-sm text-gray-500">PDF, DOC, atau DOCX (Maks. 10MB)</p>
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />

                                @if($submission && $submission->file_path)
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600">File yang sudah diupload:</p>
                                        <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            Lihat File
                                        </a>
                                    </div>
                                @endif
                            </div>

                            @if(!$submission || !$submission->graded_at)
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button>
                                        {{ $submission ? 'Perbarui Pengumpulan' : 'Kumpulkan Tugas' }}
                                    </x-primary-button>
                                </div>
                            @endif
                        </form>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Maaf, tugas ini sudah melewati tenggat waktu pengumpulan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($submission)
                <div class="mt-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Status Pengumpulan</h3>
                    <div class="bg-white/50 backdrop-blur-sm rounded-lg border p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Dikumpulkan pada:</p>
                                <p class="font-medium">{{ $submission->created_at->format('d M Y H:i') }}</p>
                                @if($submission->graded_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                        Sudah Dinilai
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-2">
                                        Belum Dinilai
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('student.assignments.submissions.show', ['assignment' => $assignment->id, 'submission' => $submission->id]) }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
