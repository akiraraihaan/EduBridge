<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <a href="{{ route('student.materials.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Daftar Materi
                        </a>
                    </div>

                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $material->title }}</h1>
                        <p class="text-gray-600">Modul: {{ $material->module->title }}</p>
                    </div>

                    @if($material->video_id)
                        <div class="mb-8">
                            <div class="relative w-full" style="padding-bottom: 56.25%">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ $material->video_id }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg"
                                    style="max-width: 1280px; max-height: 720px; margin: 0 auto;"
                                ></iframe>
                            </div>
                        </div>
                    @endif

                    @if($material->file_path)
                        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">File Lampiran</h3>
                            <a
                                href="{{ Storage::url($material->file_path) }}"
                                target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download Materi
                            </a>
                        </div>
                    @endif

                    <div class="prose max-w-none">
                        {!! $material->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
