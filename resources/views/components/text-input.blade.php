@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full pr-3 sm:pr-4 py-2 sm:py-3
              bg-white/70 backdrop-blur-md border-0
              rounded-lg sm:rounded-xl
              shadow-[0_2px_4px_rgba(0,0,0,0.02),0_1px_6px_rgba(0,0,0,0.03)]
              transition duration-200 ease-in-out
              text-sm sm:text-base text-slate-600 placeholder:text-slate-400
              hover:bg-white/90 hover:shadow-[0_2px_8px_rgba(0,0,0,0.05),0_2px_4px_rgba(0,0,0,0.03)]
              focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-100/50
              disabled:opacity-50 disabled:cursor-not-allowed'
]) !!}>
