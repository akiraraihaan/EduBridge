@props(['disabled' => false])

<div class="relative">
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' => 'w-full px-4 py-3 bg-white/70 backdrop-blur-md border-0 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02),0_1px_6px_rgba(0,0,0,0.03)]
                transition-all duration-200 ease-in-out
                text-slate-600 appearance-none
                hover:bg-white/90 hover:shadow-[0_2px_8px_rgba(0,0,0,0.05),0_2px_4px_rgba(0,0,0,0.03)]
                focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-100/50
                disabled:opacity-50 disabled:cursor-not-allowed'
    ]) !!}>
        {{ $slot }}
    </select>
    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
</div>
