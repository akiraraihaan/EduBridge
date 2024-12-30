<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased" style="font-family: Mona sans">
        <div class="min-h-[10vh] flex items-center bg-white shadow-md">
            <div class="ml-10 mr-auto flex justify-center items-center">
                <h1 class="font-bold italic p-2">{{ env('APP_NAME') }}</h1>
            </div>
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="max-h-[35px]">
            </div>
            @if (Route::has('login'))
                <div class="flex gap-4 mr-10 ml-auto items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-4 py-2 bg-[#1A1A1A] border border-4 border-green-600 rounded-xl font-semibold text-sm text-white hover:bg-[#4C4C4C] transition duration-700">
                            {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 bg-[#1A1A1A] rounded-xl font-semibold text-sm text-white hover:bg-[#4C4C4C] transition duration-700">
                            Log in
                        </a>

                        <span class="font-bold">or</span>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-4 py-2 bg-[#1A1A1A] rounded-xl font-semibold text-sm text-white hover:bg-[#4C4C4C] transition duration-700">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <header class="flex flex-col items-center justify-center h-[20vh] bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90% relative z-[-1]">
            <h2 class="text-2xl font-semibold">Get skilled  with</h2>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-black via-gray-400 to-gray-900 bg-clip-text text-transparent tracking-tight">Payless Education</h1>
        </header>

        <div class="max-w-screen my-16 ">
            <!-- Background Image -->
            <img src="/img/ask_icon.png"
                 alt="background"
                 class="absolute inset-0 max-h-[120px] mt-[275px] ml-[350px] object-cover">

            <div class="relative max-w-[50vw] min-h-[20vh] m-auto">
                <!-- Glass Card Effect -->
                <div class="relative h-full flex items-center justify-center">
                    <div class="w-full h-full bg-slate-500/30 backdrop-blur-sm rounded-2xl shadow-md p-6 flex items-center justify-center">
                        <p class="text-black m-6">
                            <b>EduBridge</b> memfasilitasi pemberian beasiswa dan perusahaan kepada peserta pelatihan,
                            serta membantu menghubungkan lulusan dengan peluang kerja di perusahaan mitra
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen flex flex-col items-center justify-center h-[20vh] bg-gradient-to-r from-[#bae8ff]/30 from-10% via-[#e2f5ff]/30 via-45% to-[#bae8ff]/30 to-90% min-h-[50vh]">
            <div class="flex flex-row items-center justify-center gap-8 w-5/6 bg-white rounded-xl p-4 shadow-md">
                @foreach ( $requirements as $requirement )
                <div class="h-[270px] w-fit flex flex-col items-start justify-end rounded-xl" style="background-image: url('{{ $requirement['img'] }}'); background-size: cover; background-position: center;">
                    <p class="text-[12px] text-slate-800 p-2 bg-white mx-4 my-2 rounded-md">{{ $requirement['requirement'] }}</p>
                    <h1 class="font-bold text-white w-full bg-black/30 px-4 py-2 rounded-b-xl">{{ $requirement['statement'] }}</h1>
                </div>
                @endforeach
            </div>
        </div>

        <div class="max-w-screen min-h-[100vh] flex">
            <img src="/img/logo.png"
                 alt="background"
                 class="absolute inset-0 min-h-[300px] mt-[1175px] ml-[350px] opacity-30 object-cover">

            <div>

            </div>
        </div>

        <footer>
            <div class="max-w-screen flex flex-row items-start py-20 justify-between px-20 h-[40vh] bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90%">
                <div class="w-1/5 flex flex-col items-center justify-center gap-4">
                    <img src="{{ asset('img/logo.png') }}" alt="EduBridge Logo" class="max-h-[45px]">
                    <h2 class="text-xl font-bold italic">
                        EduBridge
                    </h2>
                    <p class="text-slate-700 tracking-wide">
                        {{ $definition }}
                    </p>
                </div>
                <div class="w-1/5 flex flex-col items-start justify-center gap-4">
                    <h2 class="text-xl font-bold tracking-wide">
                        PUSAT BANTUAN
                    </h2>
                    <div class="flex flex-col leading-relaxed">
                        <a href="#" class="hover:text-orange-700 transition duration-700">Kursus</a>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Pendaftaran</a>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Reviews</a>
                        <a href="#" class="hover:text-orange-700 transition duration-700">Tentang Kami</a>
                    </div>
                </div>
                <div class="w-1/5 flex flex-col items-start justify-center gap-4">
                    <h2 class="text-xl font-bold tracking-wide">
                        INFO KONTAK
                    </h2>
                    <div class="flex flex-col leading-relaxed">
                        <a>{{ $contact['phone'] }}</a>
                        <a>{{ $contact['email'] }}</a>
                        <a>{{  $contact['address'] }}</a>
                    </div>
                </div>
            </div>
            <div class="h-[7vh] bg-[#1A1A1A] max-w-screen flex items-center justify-center">
                <p class="text-white text-sm tracking-wide">
                    © 2024 EduBridge Team | All rights reserved
                </p>
            </div>
        </footer>
    </body>
</html>
