@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 my-1 text-start text-sm font-medium text-blue-600 bg-blue-50 rounded-md transition duration-300 ease-in-out hover:bg-blue-100'
            : 'block w-full ps-3 pe-4 py-2 my-1 text-start text-sm font-medium text-gray-600 hover:text-blue-500 hover:bg-blue-50 rounded-md transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
