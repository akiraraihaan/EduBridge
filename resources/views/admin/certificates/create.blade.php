<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terbitkan Sertifikat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                Tipe Sertifikat
                            </label>
                            <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Pilih Tipe</option>
                                <option value="student">Student</option>
                                <option value="mentor">Mentor</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                                Pilih Penerima
                            </label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Pilih Penerima</option>
                                <optgroup label="Students">
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" data-type="student">
                                            {{ $student->first_name }} {{ $student->last_name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Mentors">
                                    @foreach($mentors as $mentor)
                                        <option value="{{ $mentor->id }}" data-type="mentor">
                                            {{ $mentor->first_name }} {{ $mentor->last_name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Deskripsi (Opsional)
                            </label>
                            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="certificate_file">
                                File Sertifikat (PDF)
                            </label>
                            <input type="file" name="certificate_file" id="certificate_file" accept=".pdf" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <p class="text-sm text-gray-500 mt-1">Maksimal ukuran file: 5MB</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Terbitkan Sertifikat
                            </button>
                            <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('type').addEventListener('change', function() {
            const type = this.value;
            const userSelect = document.getElementById('user_id');
            const options = userSelect.options;

            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                if (option.dataset.type) {
                    option.style.display = option.dataset.type === type ? '' : 'none';
                }
            }

            userSelect.value = '';
        });
    </script>
    @endpush
</x-app-layout>
