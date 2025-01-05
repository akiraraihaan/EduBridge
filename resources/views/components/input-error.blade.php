@props(['messages'])

@if ($messages)
    <div class="mt-1.5">
        @foreach ((array) $messages as $message)
            <p class="text-sm text-red-500 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $message }}
            </p>
        @endforeach
    </div>
@endif
