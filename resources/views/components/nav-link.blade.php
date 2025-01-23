@props(['active', 'isHome' => false])

@php
$baseClasses = 'inline-flex items-center px-3 py-1.5 my-3 text-sm font-medium transition duration-300 ease-in-out rounded-md mx-1';

$classes = ($active ?? false)
    ? $baseClasses . ' bg-blue-100 text-blue-600 hover:bg-blue-200'
    : $baseClasses . ' text-gray-600 hover:bg-blue-50 hover:text-blue-500';

$animation = 'hover:-translate-y-[0.5px]';
$classes .= ' transform ' . $animation;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($isHome)
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    @endif
    {{ $slot }}
</a>
