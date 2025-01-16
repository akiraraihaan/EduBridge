<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative">
            <!-- Background blur -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-purple-100 opacity-75 filter blur-3xl"></div>

            <!-- Content -->
            <div class="relative bg-white/30 backdrop-blur-lg rounded-xl shadow-xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Batch Baru</h2>
                    <a href="{{ route('admin.batches.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
                        Kembali
                    </a>
                </div>

                <form action="{{ route('admin.batches.store') }}" method="POST" id="createBatchForm">
                    @csrf

                    @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Batch Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Batch</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required placeholder="Contoh: Batch 1 2024">
                        </div>

                        <!-- Year -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                            <input type="number" name="year" id="year" value="{{ old('year', date('Y')) }}"
                                min="2024" max="2100"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <!-- Period -->
                        <div>
                            <label for="period" class="block text-sm font-medium text-gray-700 mb-1">Periode</label>
                            <select name="period" id="period" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="">Pilih Periode</option>
                                <option value="1" {{ old('period') == 1 ? 'selected' : '' }}>Januari - Maret</option>
                                <option value="2" {{ old('period') == 2 ? 'selected' : '' }}>April - Juni</option>
                                <option value="3" {{ old('period') == 3 ? 'selected' : '' }}>Juli - September</option>
                                <option value="4" {{ old('period') == 4 ? 'selected' : '' }}>Oktober - Desember</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <!-- Capacity -->
                        <div class="md:col-span-2">
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 1000) }}"
                                min="1" max="1000"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                            <p class="mt-1 text-sm text-gray-500">Maksimal 1000 siswa per batch (166 siswa per kursus)</p>
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <div class="flex space-x-6">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <span class="ml-2 text-sm text-gray-700">Aktifkan Batch</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_open" value="1"
                                        {{ old('is_open') ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <span class="ml-2 text-sm text-gray-700">Buka Pendaftaran</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="window.location.href='{{ route('admin.batches.index') }}'"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all">
                            Simpan Batch
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createBatchForm');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    // Set min date for start_date to today
    const today = new Date().toISOString().split('T')[0];
    startDateInput.min = today;

    // Update end_date min when start_date changes
    startDateInput.addEventListener('change', function() {
        endDateInput.min = this.value;
        if (endDateInput.value && endDateInput.value < this.value) {
            endDateInput.value = this.value;
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate dates
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (endDate < startDate) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai'
            });
            return;
        }

        // Submit form
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ route('admin.batches.index') }}';
                });
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        });
    });
});
</script>
@endpush
</x-app-layout>

