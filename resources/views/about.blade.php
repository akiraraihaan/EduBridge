<x-app-final-layout>
    <!-- Header -->
    <header class="flex flex-col items-center justify-center h-[20vh] bg-gradient-to-r from-[#ffe9d5] from-10% via-[#fffbf7] via-45% to-[#ffe9d5] to-90% relative shadow-lg mt-16">
        <h2 class="text-2xl font-semibold fade-down">Tentang</h2>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-black via-gray-400 to-gray-900 bg-clip-text text-transparent tracking-tight fade-up">
            EduBridge</h1>
    </header>

    <!-- Team Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12 fade-down">
            <h2 class="text-[44px] font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-orange-800 mb-4">Tim Kami</h2>
        </div>

        <div class="flex flex-wrap -mx-4">
            @foreach($data['team'] as $member)
                <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-8 fade-up" style="animation-delay: {{ $loop->index * 0.2 }}s">
                    <div class="h-[300px] w-full overflow-hidden">
                        <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-110" src="{{ $member['image'] }}" alt="{{ $member['name'] }}">
                    </div>
                    <div class="bg-white/80 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $member['name'] }}</h3>
                            <p class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400 font-medium mt-1">{{ $member['position'] }}</p>
                            <p class="text-gray-500 mt-4">{{ $member['description'] }}</p>

                            <div class="flex space-x-4 mt-6 justify-end">
                                <a href="{{ $member['ig'] }}" class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-lg shadow-lg hover:shadow-pink-500/50 transition-all duration-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                    </svg>
                                </a>
                                <a href="{{ $member['github'] }}" class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-gray-700 to-gray-900 text-white rounded-lg shadow-lg hover:shadow-gray-500/50 transition-all duration-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Vision & Mission Section -->
    <div class="relative py-12 md:py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-blue-50 opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center fade-up mb-20">
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-orange-800 mb-4">Visi & Misi Kami</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Vision Section -->
                <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 fade-right">
                    <div class="flex flex-col space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-orange-100 rounded-2xl">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-orange-400 bg-clip-text text-transparent">Visi Kami</h2>
                        </div>
                        <div class="flex-grow flex items-center">
                            <p class="text-lg text-gray-700 leading-relaxed">
                                {{ $data['vision'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 fade-left">
                    <div class="flex flex-col space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-100 rounded-2xl">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">Misi Kami</h2>
                        </div>
                        <div class="flex-grow flex items-center">
                            <ul class="space-y-4 w-full">
                                @foreach($data['missions'] as $mission)
                                    <li class="flex items-start space-x-3">
                                        <span class="flex-shrink-0 w-1.5 h-1.5 mt-2 rounded-full bg-blue-500"></span>
                                        <span class="text-lg text-gray-700">{{ $mission }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-final-layout>

<style>
    .fade-up {
        opacity: 0;
        animation: fadeUp 0.8s ease forwards;
    }

    .fade-down {
        opacity: 0;
        animation: fadeDown 0.8s ease forwards;
    }

    .fade-left {
        opacity: 0;
        animation: fadeLeft 0.8s ease forwards;
    }

    .fade-right {
        opacity: 0;
        animation: fadeRight 0.8s ease forwards;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
