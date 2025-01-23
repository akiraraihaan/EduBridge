<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Materi') }}
            </h2>
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-600">
                    Anda adalah mentor untuk kursus:
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $course->name }}
                    </span>
                </div>
                <a href="{{ route('mentor.materials.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Materi
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white/50 backdrop-blur-sm shadow-sm overflow-hidden sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ $course->name }}</h3>

                    @foreach($course->modules->sortBy('order') as $module)
                        <div id="module-{{ $module->id }}" class="mb-6 last:mb-0">
                            <h4 class="text-md font-medium mb-2">{{ $module->title }}</h4>

                            @if($module->materials->count() > 0)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($module->materials->sortBy('order') as $material)
                                            <div class="bg-white p-4 rounded-lg shadow">
                                                <div class="flex items-center mb-2">
                                                    @if($material->type === 'pdf')
                                                        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    @endif
                                                    <h5 class="font-medium">{{ $material->title }}</h5>
                                                </div>

                                                <div class="text-sm text-gray-600 mb-4">
                                                    {{ Str::limit($material->content, 100) }}
                                                </div>

                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-500">Urutan: {{ $material->order }}</span>
                                                    <div class="space-x-2">
                                                        <a href="{{ route('mentor.materials.edit', $material) }}" class="text-blue-600 hover:text-blue-800">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('mentor.materials.destroy', $material) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Belum ada materi untuk modul ini</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if(session('scrollTo'))
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const element = document.getElementById('{{ session('scrollTo') }}');
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    element.classList.add('bg-yellow-50');
                    setTimeout(() => {
                        element.classList.remove('bg-yellow-50');
                    }, 2000);
                }
            });
        </script>
        @endpush
    @endif
</x-app-layout>
