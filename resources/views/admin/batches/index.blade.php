<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/40 backdrop-blur-lg rounded-xl sm:rounded-2xl p-6 sm:p-8 shadow-xl border border-white/50">
                    <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-slate-700">Manajemen Batch</h2>
                    <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create-batch')"
                        class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] rounded-xl font-medium text-sm sm:text-base text-slate-800 hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 ease-in-out"
                        >
                            Tambah Batch
                    </button>
                    </div>

                    <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200/50">
                            <thead>
                                <tr>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-700 uppercase tracking-wider rounded-tl-xl">Batch</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Kapasitas</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-700 uppercase tracking-wider rounded-tr-xl">Aksi</th>
                                </tr>
                            </thead>
                        <tbody class="bg-white/20 backdrop-blur-md divide-y divide-gray-200/50">
                                @foreach ($batches as $batch)
                                <tr class="hover:bg-white/30 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                            {{ $batch->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($batch->end_date)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        <div class="flex items-center">
                                            <div class="flex-1 h-2 bg-gray-200 rounded-full mr-2">
                                                <div class="h-2 bg-blue-500 rounded-full" style="width: {{ ($batch->enrolled_count / $batch->capacity) * 100 }}%"></div>
                                            </div>
                                            <span class="text-xs">{{ $batch->enrolled_count }}/{{ $batch->capacity }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($batch->is_active)
                                            @if($batch->is_open)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Pendaftaran Dibuka
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pendaftaran Ditutup
                                                </span>
                                            @endif
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <button
                                                onclick="toggleBatchStatus('{{ $batch->id }}')"
                                                class="px-3 py-1 text-sm rounded-md {{ $batch->is_active ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} transition-colors duration-200 flex items-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                </svg>
                                                {{ $batch->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                            @if($batch->is_active)
                                            <button
                                                onclick="toggleRegistrationStatus('{{ $batch->id }}')"
                                                class="px-3 py-1 text-sm rounded-md {{ $batch->is_open ? 'bg-yellow-50 text-yellow-600 hover:bg-yellow-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} transition-colors duration-200 flex items-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                </svg>
                                                {{ $batch->is_open ? 'Tutup Pendaftaran' : 'Buka Pendaftaran' }}
                                            </button>
                                            @endif
                                            <button
                                                onclick="editBatch('{{ $batch->id }}')"
                                                class="px-3 py-1 text-sm rounded-md bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition-colors duration-200 flex items-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button
                                                onclick="deleteBatch('{{ $batch->id }}')"
                                                class="px-3 py-1 text-sm rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-200 flex items-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $batches->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Batch -->
    <x-modal name="create-batch" :show="false">
        <form method="POST" action="{{ route('admin.batches.store') }}" class="p-6" id="createBatchForm">
            @csrf

            @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 text-red-500 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h2 class="text-lg font-medium text-slate-700 mb-4">Tambah Batch Baru</h2>

            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Nama Batch')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required placeholder="Contoh: Batch 1 2024" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="start_date" :value="__('Tanggal Mulai')" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="end_date" :value="__('Tanggal Selesai')" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" required />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="capacity" :value="__('Kapasitas')" />
                    <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity', 1000)" required min="1" max="1000" />
                    <p class="mt-1 text-sm text-slate-500">Maksimal 1000 siswa per batch (166 siswa per kursus)</p>
                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex items-center">
                        <input id="is_active" name="is_active" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                        <label for="is_active" class="ml-2 block text-sm text-slate-600">Aktif</label>
                    </div>
                    <div class="flex items-center">
                        <input id="is_open" name="is_open" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_open" class="ml-2 block text-sm text-slate-600">Buka Pendaftaran</label>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200" x-on:click="$dispatch('close')">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-[#ffe9d5] to-[#ffe1c5] text-slate-800 rounded-lg hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </x-modal>

    <script>
        // Setup CSRF token untuk semua request AJAX
        window.addEventListener('load', function() {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        });

        window.toggleBatchStatus = function(batchId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Status batch akan diubah!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/admin/batches/${batchId}/toggle-status`)
                        .then(response => {
                            if (response.data.status === 'success') {
                                Swal.fire(
                                    'Berhasil!',
                                    'Status batch telah diubah.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                error.response.data.message,
                                'error'
                            );
                        });
                }
            });
        }

        window.toggleRegistrationStatus = function(batchId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Status pendaftaran batch akan diubah!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/admin/batches/${batchId}/toggle-registration`)
                        .then(response => {
                            if (response.data.status === 'success') {
                                Swal.fire(
                                    'Berhasil!',
                                    'Status pendaftaran batch telah diubah.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                error.response.data.message,
                                'error'
                            );
                        });
                }
            });
        }

        window.editBatch = function(batchId) {
            window.location.href = `/admin/batches/${batchId}/edit`;
        }

        window.deleteBatch = function(batchId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Batch yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/batches/${batchId}`)
                        .then(response => {
                            if (response.data.status === 'success') {
                                Swal.fire(
                                    'Terhapus!',
                                    'Batch telah dihapus.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                error.response.data.message,
                                'error'
                            );
                        });
                }
            });
        }

        // Validasi tanggal
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('start_date').addEventListener('change', function() {
                document.getElementById('end_date').min = this.value;
            });

            document.getElementById('end_date').addEventListener('change', function() {
                document.getElementById('start_date').max = this.value;
            });
        });
    </script>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-app-layout>
