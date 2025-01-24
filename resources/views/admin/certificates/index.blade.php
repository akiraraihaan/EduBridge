<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Sertifikat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mentor Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Mentor</h3>
                <div class="bg-white/50 backdrop-blur-sm overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Course</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Sertifikat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 backdrop-blur-sm divide-y divide-gray-200">
                                    @forelse($mentors as $mentor)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $mentor->first_name }} {{ $mentor->last_name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $mentor->email }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    {{ $mentor->course->name ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mentor->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $mentor->is_active ? 'Aktif' : 'Non-aktif' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($mentor->certificates->count() > 0)
                                                    @foreach($mentor->certificates as $certificate)
                                                        <div class="flex items-center space-x-2 mb-1">
                                                            <button onclick="openPdfModal('{{ $certificate->id }}')" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-900">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                                {{ $certificate->certificate_number }}
                                                            </button>
                                                            <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span class="text-sm text-gray-500">Belum ada sertifikat</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <button onclick="openCertificateModal({{ $mentor->id }}, 'mentor', '{{ $mentor->first_name }} {{ $mentor->last_name }}')" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                    Beri Sertifikat
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Belum ada mentor yang terdaftar
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Section -->
            @foreach($courses as $course)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        {{ $course->name }}
                        <span class="ml-2 text-sm text-gray-500">({{ $course->students->count() }} siswa)</span>
                    </h3>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            @if($course->students->isEmpty())
                                <p class="text-sm text-gray-500">Belum ada siswa di course ini</p>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Nama</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Email</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Sertifikat</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($course->students as $student)
                                                <tr>
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $student->first_name }} {{ $student->last_name }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm text-gray-900">{{ $student->email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $student->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $student->is_active ? 'Aktif' : 'Non-aktif' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @if($student->certificates->count() > 0)
                                                            @foreach($student->certificates as $certificate)
                                                                <div class="flex items-center space-x-2 mb-1">
                                                                    <button onclick="openPdfModal('{{ $certificate->id }}')" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-900">
                                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                        </svg>
                                                                        {{ $certificate->certificate_number }}
                                                                    </button>
                                                                    <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" class="inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <span class="text-sm text-gray-500">Belum ada sertifikat</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <button onclick="openCertificateModal({{ $student->id }}, 'student', '{{ $student->first_name }} {{ $student->last_name }}')" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                            Beri Sertifikat
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
            @endforeach
        </div>
    </div>

    <!-- Modal untuk input sertifikat -->
    <div id="certificateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Beri Sertifikat</h3>
                <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="hidden" name="user_id" id="certificateUserId">
                    <input type="hidden" name="type" id="certificateType">

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Penerima:</label>
                        <p id="certificateRecipient" class="text-gray-600"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Deskripsi (Opsional)
                        </label>
                        <textarea name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="certificate_file">
                            File Sertifikat (PDF)
                        </label>
                        <input type="file" name="certificate_file" accept=".pdf" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <p class="text-sm text-gray-500 mt-1">Maksimal ukuran file: 5MB</p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeCertificateModal()" class="px-4 py-2 text-gray-500 hover:text-gray-700">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Kirim Sertifikat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk preview PDF -->
    <div id="pdfModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                    Preview Sertifikat
                                </h3>
                                <div class="mt-2">
                                    <iframe id="pdfViewer" class="w-full h-[600px]" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                            onclick="closePdfModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openPdfModal(certificateId) {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');
            const certificates = @json($certificates);

            const certificate = certificates.find(c => c.id == certificateId);
            if (certificate && certificate.file_path) {
                pdfViewer.src = '/storage/' + certificate.file_path;
                modal.classList.remove('hidden');
            }
        }

        function closePdfModal() {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.src = '';
            modal.classList.add('hidden');
        }

        function openCertificateModal(userId, type, name) {
            document.getElementById('certificateModal').classList.remove('hidden');
            document.getElementById('certificateUserId').value = userId;
            document.getElementById('certificateType').value = type;
            document.getElementById('certificateRecipient').textContent = name;
        }

        function closeCertificateModal() {
            document.getElementById('certificateModal').classList.add('hidden');
        }

        // Tutup modal saat klik di luar modal
        window.onclick = function(event) {
            const modal = document.getElementById('pdfModal');
            const certModal = document.getElementById('certificateModal');
            if (event.target == modal) {
                closePdfModal();
            }
            if (event.target == certModal) {
                closeCertificateModal();
            }
        }
    </script>
</x-app-layout>
