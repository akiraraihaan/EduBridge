<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Detail Tugas') }}
                </h2>
                <div class="text-sm text-gray-600 mt-1">
                    Anda adalah mentor untuk kursus:
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $assignment->module->course->name }}
                    </span>
                </div>
            </div>
            <a href="{{ route('mentor.assignments.edit', $assignment) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Tugas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Detail Tugas -->
            <div class="bg-white/50 backdrop-blur-sm shadow-sm overflow-hidden sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Tugas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Modul</p>
                                <p class="font-medium">{{ $assignment->module->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <p>
                                    @if($assignment->status === 'published')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Dipublikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Draft
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tenggat Waktu</p>
                                <p class="font-medium">{{ $assignment->due_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nilai Maksimal</p>
                                <p class="font-medium">{{ $assignment->max_score }}</p>
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

            <!-- Daftar Pengumpulan -->
            <div class="bg-white/50 backdrop-blur-sm shadow-sm overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Pengumpulan Tugas</h3>

                    @if($assignment->submissions->isEmpty())
                        <p class="text-gray-500 text-sm">Belum ada siswa yang mengumpulkan tugas ini</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pengumpulan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($assignment->submissions as $submission)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $submission->student->first_name }} {{ $submission->student->last_name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $submission->submitted_at->format('d M Y H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($submission->graded_at)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Sudah Dinilai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Belum Dinilai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $submission->score ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="openGradeModal('{{ $submission->id }}', '{{ $submission->student->first_name }} {{ $submission->student->last_name }}', '{{ $submission->content }}', '{{ $submission->score }}', '{{ $submission->feedback }}', '{{ $submission->file_path }}')" class="text-blue-600 hover:text-blue-900">
                                                    Lihat & Nilai
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penilaian -->
    <div id="gradeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 50;">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Penilaian Tugas</h3>
                <p class="text-sm text-gray-500 mb-4">Siswa: <span id="studentName"></span></p>

                <div class="mb-4">
                    <h4 class="text-md font-medium text-gray-900 mb-2">Jawaban Siswa:</h4>
                    <div id="submissionContent" class="text-sm text-gray-600 bg-gray-50 p-4 rounded-md"></div>

                    <!-- PDF Preview -->
                    <div id="pdfPreview" class="mt-4 hidden">
                        <h4 class="text-md font-medium text-gray-900 mb-2">File Submission:</h4>
                        <embed id="pdfViewer" src="" type="application/pdf" width="100%" height="500px" class="border rounded-md">
                    </div>
                </div>

                <form id="gradeForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="score" class="block text-sm font-medium text-gray-700">Nilai</label>
                        <input type="number" name="score" id="score" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
                        <textarea name="feedback" id="feedback" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeGradeModal()" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Definisikan fungsi-fungsi sebagai variabel global
        window.openGradeModal = function(submissionId, studentName, content, score, feedback, filePath) {
            document.getElementById('gradeModal').classList.remove('hidden');
            document.getElementById('studentName').textContent = studentName;
            document.getElementById('submissionContent').textContent = content;
            document.getElementById('score').value = score || '';
            document.getElementById('feedback').value = feedback || '';
            document.getElementById('gradeForm').action = "{{ route('mentor.assignments.submissions.grade', ['submission' => ':id']) }}".replace(':id', submissionId);

            // Handle PDF preview
            const pdfPreview = document.getElementById('pdfPreview');
            const pdfViewer = document.getElementById('pdfViewer');

            if (filePath) {
                pdfPreview.classList.remove('hidden');
                pdfViewer.src = "{{ asset('storage') }}/" + filePath;
            } else {
                pdfPreview.classList.add('hidden');
                pdfViewer.src = '';
            }
        }

        window.closeGradeModal = function() {
            document.getElementById('gradeModal').classList.add('hidden');
            document.getElementById('pdfViewer').src = ''; // Clear PDF source when closing
        }

        // Event listener untuk menutup modal saat mengklik di luar
        document.getElementById('gradeModal').addEventListener('click', function(e) {
            if (e.target === this) {
                window.closeGradeModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
