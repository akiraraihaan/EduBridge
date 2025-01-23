<x-app-layout>
    <div class="min-h-screen bg-white/50 backdrop-blur-sm/20">
        <!-- Welcome Banner -->
        <div class="bg-white/50 backdrop-blur-sm shadow-sm border-b">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Mentor</h1>
                        <p class="mt-1 text-sm text-gray-500">Kelola kelas dan siswa Anda</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            Mentor
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                            <h3 class="text-xl font-bold text-gray-900">0</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Tugas Selesai</p>
                            <h3 class="text-xl font-bold text-gray-900">0</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Jadwal Hari Ini</p>
                            <h3 class="text-xl font-bold text-gray-900">0</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jadwal Mengajar Hari Ini -->
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Jadwal Mengajar Hari Ini</h2>
                    <div class="divide-y divide-gray-200">
                        <div class="py-3">
                            <p class="text-sm text-gray-500">Tidak ada jadwal mengajar hari ini</p>
                        </div>
                    </div>
                </div>

                <!-- Tugas yang Perlu Dinilai -->
                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Tugas yang Perlu Dinilai</h2>
                    <div class="divide-y divide-gray-200">
                        <div class="py-3">
                            <p class="text-sm text-gray-500">Tidak ada tugas yang perlu dinilai</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performa Siswa -->
            <div class="mt-6 bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Performa Rata-rata Siswa</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-500">Rata-rata Nilai</span>
                                <span class="text-sm font-medium text-gray-900">0</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
