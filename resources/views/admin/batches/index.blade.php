<x-app-layout>
    <!-- Background with blur effect -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-48 md:w-72 h-48 md:h-72 bg-[#bae8ff] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-40 right-20 w-48 md:w-72 h-48 md:h-72 bg-[#ffe9d5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-40 w-48 md:w-72 h-48 md:h-72 bg-[#ffe1c5] rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>
    </div>

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
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-600 uppercase tracking-wider rounded-tl-xl">Batch</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Kapasitas</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-white/30 backdrop-blur-md text-left text-xs font-medium text-slate-600 uppercase tracking-wider rounded-tr-xl">Aksi</th>
                                </tr>
                            </thead>
                        <tbody class="bg-white/20 backdrop-blur-md divide-y divide-gray-200/50">
                                @foreach ($batches as $batch)
                                <tr class="hover:bg-white/30 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                            {{ $batch->name }}
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ $batch->year }} P{{ $batch->period }} ({{ $batch->period_name }})
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        <div class="flex items-center">
                                            <div class="flex-1 h-2 bg-gray-200 rounded-full mr-2">
                                                <div class="h-2 bg-blue-500 rounded-full" style="width: {{ $batch->progress_percentage }}%"></div>
                                            </div>
                                            <span class="text-xs">{{ $batch->enrolled_count }}/{{ $batch->capacity }}</span>
                                        </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                        {!! $batch->status_badge !!}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-3">
                                            <button
                                                onclick="toggleBatchStatus('{{ $batch->id }}')"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                            >
                                                {{ $batch->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                            @if($batch->is_active)
                                            <button
                                                onclick="toggleRegistrationStatus('{{ $batch->id }}')"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                            >
                                                {{ $batch->is_open ? 'Tutup Pendaftaran' : 'Buka Pendaftaran' }}
                                            </button>
                                            @endif
                                            <button
                                                onclick="editBatch('{{ $batch->id }}')"
                                                class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                            >
                                                Edit
                                            </button>
                                            <button
                                                onclick="deleteBatch('{{ $batch->id }}')"
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                            >
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
            <h2 class="text-lg font-medium text-slate-700 mb-4">Tambah Batch Baru</h2>

            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Nama Batch')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required placeholder="Contoh: Batch 1 2024" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="year" :value="__('Tahun')" />
                        <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year', date('Y'))" required min="2024" />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="period" :value="__('Periode')" />
                        <select id="period" name="period" class="w-full mt-1 px-4 py-2 bg-white/70 backdrop-blur-md border-0 rounded-xl shadow-sm transition duration-200 ease-in-out text-slate-600 hover:bg-white/90 focus:ring-2 focus:ring-blue-200" required>
                            <option value="" disabled selected>Pilih Periode</option>
                            <option value="1" {{ old('period') == 1 ? 'selected' : '' }}>Januari - Maret</option>
                            <option value="2" {{ old('period') == 2 ? 'selected' : '' }}>April - Juni</option>
                            <option value="3" {{ old('period') == 3 ? 'selected' : '' }}>Juli - September</option>
                            <option value="4" {{ old('period') == 4 ? 'selected' : '' }}>Oktober - Desember</option>
                        </select>
                        <x-input-error :messages="$errors->get('period')" class="mt-2" />
                    </div>
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

    @push('scripts')
    <script>
        // Setup CSRF token untuk semua request AJAX
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function toggleBatchStatus(batchId) {
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
                    axios.post(`{{ route('admin.batches.toggle-status', '') }}/${batchId}`)
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

        function toggleRegistrationStatus(batchId) {
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
                    axios.post(`{{ route('admin.batches.toggle-registration', '') }}/${batchId}`)
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

        function editBatch(batchId) {
            window.location.href = `{{ route('admin.batches.edit', '') }}/${batchId}`;
        }

        function deleteBatch(batchId) {
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
                    axios.delete(`{{ route('admin.batches.destroy', '') }}/${batchId}`)
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

        document.getElementById('createBatchForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            axios.post(this.action, formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Batch berhasil dibuat.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                        window.location.reload();
                        });
                    }
                })
                .catch(error => {
                    let errorMessage = 'Terjadi kesalahan saat membuat batch';
                    if (error.response && error.response.data && error.response.data.message) {
                        errorMessage = error.response.data.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage
                    });
                });
        });

        // Validasi tanggal
        document.getElementById('start_date').addEventListener('change', function() {
            document.getElementById('end_date').min = this.value;
        });

        document.getElementById('end_date').addEventListener('change', function() {
            document.getElementById('start_date').max = this.value;
        });
    </script>
    @endpush

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
