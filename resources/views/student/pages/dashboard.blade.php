<x-app-layout>
    <div class="min-h-screen bg-white/20">
        <!-- Welcome Banner -->
        <div class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Siswa</h1>
                        <p class="mt-1 text-sm text-gray-500">Pantau progress pembelajaran Anda</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                            Siswa
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Progress Kursus -->
            <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-md border border-gray-200 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Kursus yang Sedang Diikuti</h2>
                <div class="space-y-4">
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-medium text-gray-900">Belum Ada Kursus</h3>
                            <span class="text-sm text-gray-500">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-orange-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tugas Mendatang -->
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-md border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Tugas Mendatang</h2>
                    <div class="divide-y divide-gray-200">
                        <div class="py-3">
                            <p class="text-sm text-gray-500">Belum ada tugas yang perlu diselesaikan</p>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Pertemuan -->
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-md border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Jadwal Pertemuan</h2>
                    <div class="divide-y divide-gray-200">
                        <div class="py-3">
                            <p class="text-sm text-gray-500">Belum ada jadwal pertemuan yang dijadwalkan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekomendasi Kursus -->
            <div class="mt-6 bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-md border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Rekomendasi Kursus</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Belum ada rekomendasi kursus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
