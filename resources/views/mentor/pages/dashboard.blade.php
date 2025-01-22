<x-app-layout>
    <div class="min-h-screen bg-white/20">
        <!-- Welcome Banner -->
        <div class="bg-white shadow-sm border-b">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Class Overview -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Kelas</h2>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">Informasi kelas akan ditampilkan di sini</p>
                    </div>
                </div>

                <!-- Student Progress -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Progress Siswa</h2>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">Progress siswa akan ditampilkan di sini</p>
                    </div>
                </div>

                <!-- Upcoming Schedule -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Jadwal Mendatang</h2>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">Jadwal kelas akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
