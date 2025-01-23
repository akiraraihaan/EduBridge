<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduBridge') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="font-family: Mona sans">

        <div class="fixed inset-0 -z-10 overflow-hidden">
            <!-- Enhanced gradient base -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50 to-indigo-100"></div>

            <!-- Animated elegant accents -->
            <div class="absolute inset-0">
                <!-- Main accent rectangle -->
                <div class="absolute top-0 right-0 w-1/2 h-screen
                            bg-gradient-to-b from-blue-200/40 to-transparent
                            transform -skew-x-12 hidden md:block">
                </div>

                <!-- Primary animated shape -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200"
                     class="absolute hidden lg:block w-[200px] h-[200px] md:w-[300px] md:h-[300px] xl:w-[400px] xl:h-[400px] top-10 md:top-20 right-10 md:right-20 animate-[float_8s_ease-in-out_infinite] opacity-10">
                    <g clip-path="url(#cs_clip_1_misc-9)">
                        <mask id="cs_mask_1_misc-9" style="mask-type:alpha" width="200" height="200" x="0" y="0" maskUnits="userSpaceOnUse">
                            <path fill="#fff" d="M8.475 78.884C27.008 22.9 70.833 4.108 89.905 1.464c110.239-15.283 132.313 92.87 90.046 148.772-36.448 48.204-100.638 57.186-139.16 44.676C6.86 183.894-11.983 140.686 8.475 78.884z"></path>
                        </mask>
                        <g mask="url(#cs_mask_1_misc-9)">
                            <path fill="#fff" d="M200 0H0v200h200V0z"></path>
                            <path fill="url(#paint0_linear_748_4999)" d="M200 0H0v200h200V0z"></path>
                            <g filter="url(#filter0_f_748_4999)">
                                <ellipse cx="143.777" cy="167.536" fill="#FB923C" fill-opacity="0.4" rx="91.994" ry="58.126" transform="rotate(-33.875 143.777 167.536)"></ellipse>
                                <ellipse cx="68.482" cy="38.587" fill="#3B82F6" fill-opacity="0.3" rx="69.531" ry="47.75" transform="rotate(-26.262 68.482 38.587)"></ellipse>
                            </g>
                        </g>
                    </g>
                    <defs>
                        <filter id="filter0_f_748_4999" width="384.137" height="412.095" x="-77.372" y="-94.144" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                            <feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                            <feGaussianBlur result="effect1_foregroundBlur_748_4999" stdDeviation="40"></feGaussianBlur>
                        </filter>
                        <linearGradient id="paint0_linear_748_4999" x1="158.5" x2="29" y1="12.5" y2="200" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#BFDBFE"></stop>
                            <stop offset="1" stop-color="#93C5FD"></stop>
                        </linearGradient>
                        <clipPath id="cs_clip_1_misc-9">
                            <path fill="#fff" d="M0 0H200V200H0z"></path>
                        </clipPath>
                    </defs>
                </svg>

                <!-- Orange accent circle -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200"
                     class="absolute hidden md:block w-[160px] h-[160px] sm:w-[240px] sm:h-[240px] lg:w-[320px] lg:h-[320px] bottom-20 md:bottom-40 left-20 md:left-40 animate-[float_10s_ease-in-out_infinite_reverse] opacity-30">
                    <g clip-path="url(#cs_clip_1_polygon-7)">
                        <mask id="cs_mask_1_polygon-7" style="mask-type:alpha" width="182" height="200" x="9" y="0" maskUnits="userSpaceOnUse">
                            <path fill="#fff" d="M86.449 3.601a27.296 27.296 0 0127.102 0l63.805 36.514C185.796 44.945 191 53.9 191 63.594v72.812c0 9.694-5.204 18.649-13.644 23.479l-63.805 36.514a27.3 27.3 0 01-27.102 0l-63.805-36.514C14.204 155.055 9 146.1 9 136.406V63.594c0-9.694 5.204-18.649 13.644-23.48L86.45 3.602z"></path>
                        </mask>
                        <g mask="url(#cs_mask_1_polygon-7)">
                            <path fill="#fff" d="M200 0H0v200h200V0z"></path>
                            <path fill="url(#paint0_linear_polygon-7)" fill-opacity="0.3" d="M200 0H0v200h200V0z"></path>
                            <g filter="url(#filter0_f_748_4355)">
                                <path fill="#FB923C" fill-opacity="0.3" d="M209 126H-9v108h218V126z"></path>
                                <ellipse cx="87" cy="57.5" fill="#FED7AA" fill-opacity="0.3" rx="59" ry="34.5"></ellipse>
                            </g>
                        </g>
                    </g>
                    <defs>
                        <filter id="filter0_f_748_4355" width="338" height="331" x="-69" y="-37" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                            <feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                            <feGaussianBlur result="effect1_foregroundBlur_748_4355" stdDeviation="30"></feGaussianBlur>
                        </filter>
                        <linearGradient id="paint0_linear_polygon-7" x1="162" x2="49.5" y1="38" y2="150.5" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FB923C" stop-opacity="0.3"></stop>
                            <stop offset="1" stop-color="#FFEDD5" stop-opacity="0.2"></stop>
                        </linearGradient>
                        <clipPath id="cs_clip_1_polygon-7">
                            <path fill="#fff" d="M0 0H200V200H0z"></path>
                        </clipPath>
                    </defs>
                </svg>

                <!-- Decorative star shape -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200"
                     class="absolute hidden sm:block w-[128px] h-[128px] md:w-[192px] md:h-[192px] lg:w-[256px] lg:h-[256px] top-20 md:top-40 left-10 md:left-20 animate-[rotate_25s_linear_infinite]">
                    <g clip-path="url(#cs_clip_1_star-8)">
                        <mask id="cs_mask_1_star-8" style="mask-type:alpha" width="200" height="200" x="0" y="0" maskUnits="userSpaceOnUse">
                            <path fill="#fff" d="M100 0c12.424 62.382 37.256 87.456 100 100-62.759 12.544-87.591 37.618-100 100-12.424-62.382-37.256-87.471-100-100C62.758 87.456 87.591 62.382 100 0z"></path>
                        </mask>
                        <g mask="url(#cs_mask_1_star-8)">
                            <path fill="#fff" d="M200 0H0v200h200V0z"></path>
                            <path fill="url(#paint0_linear_star-8)" fill-opacity="0.3" d="M200 0H0v200h200V0z"></path>
                            <g filter="url(#filter0_f_748_star-8)">
                                <path fill="#06F" fill-opacity="0.2" d="M213 69H93v141h120V69z"></path>
                            </g>
                        </g>
                    </g>
                    <defs>
                        <filter id="filter0_f_748_star-8" width="245" height="266" x="30.5" y="6.5" color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                            <feBlend in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                            <feGaussianBlur result="effect1_foregroundBlur_748_star-8" stdDeviation="31.25"></feGaussianBlur>
                        </filter>
                        <linearGradient id="paint0_linear_star-8" x1="162" x2="49.5" y1="38" y2="150.5" gradientUnits="userSpaceOnUse">
                            <stop stop-color="rgb(219,234,254)" stop-opacity="0.3"></stop>
                            <stop offset="0.5" stop-color="rgb(255,237,213)" stop-opacity="0.2"></stop>
                            <stop offset="1" stop-color="rgb(219,234,254)" stop-opacity="0.3"></stop>
                        </linearGradient>
                        <clipPath id="cs_clip_1_star-8">
                            <path fill="#fff" d="M0 0H200V200H0z"></path>
                        </clipPath>
                    </defs>
                </svg>
            </div>
        </div>

        <style>
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(0, 20px); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        </style>

        <div class="min-h-screen ">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Stack for additional scripts -->
        @stack('scripts')
    </body>
</html>
