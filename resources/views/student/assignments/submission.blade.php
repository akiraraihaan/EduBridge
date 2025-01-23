<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Submission') }}
        </h2>
        <div class="text-sm text-gray-600 mt-1">
            {{ $assignment->title }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('student.assignments.show', $assignment) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Detail Tugas
                </a>
            </div>

            <div class="bg-white/50 backdrop-blur-sm overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Status dan Nilai -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Status</h3>
                                @if($submission->graded_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Sudah Dinilai
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Belum Dinilai
                                    </span>
                                @endif
                            </div>
                            @if($submission->graded_at)
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Nilai</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $submission->score }}/{{ $assignment->max_score }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Jawaban -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Jawaban Anda</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $submission->content }}</p>
                        </div>
                    </div>

                    <!-- File Submission -->
                    @if($submission->file_path)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">File Submission</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <embed src="{{ asset('storage/' . $submission->file_path) }}" type="application/pdf" width="100%" height="600px" class="border rounded-md">
                        </div>
                    </div>
                    @endif

                    <!-- Feedback -->
                    @if($submission->graded_at)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Feedback dari Mentor</h3>
                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $submission->feedback ?: 'Tidak ada feedback' }}</p>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Dinilai pada: {{ $submission->graded_at->format('d M Y H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
