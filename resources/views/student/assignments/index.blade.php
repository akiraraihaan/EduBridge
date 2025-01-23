<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($assignments->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="text-gray-500 text-sm">Belum ada tugas yang tersedia</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach($assignments as $assignment)
                        <div class="bg-white/50 backdrop-blur-sm overflow-hidden shadow-md sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $assignment->title }}
                                            @if($assignment->is_final_project)
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    Final Project
                                                </span>
                                            @endif
                                        </h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $assignment->module->title }}</p>
                                    </div>
                                    <div class="text-right">
                                        @php
                                            $submission = $assignment->submissions->first();
                                        @endphp
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

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Tenggat Waktu</p>
                                        <p class="font-medium">{{ $assignment->due_date->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Nilai Maksimal</p>
                                        <p class="font-medium">{{ $assignment->max_score }}</p>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('student.assignments.show', $assignment) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ $submission ? 'Lihat Pengumpulan' : 'Kerjakan' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
