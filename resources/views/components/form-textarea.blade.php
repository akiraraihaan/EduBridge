@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full px-4 py-3 bg-white/70 backdrop-blur-md border-0 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02),0_1px_6px_rgba(0,0,0,0.03)]
              transition-all duration-200 ease-in-out
              text-slate-600
              hover:bg-white/90 hover:shadow-[0_2px_8px_rgba(0,0,0,0.05),0_2px_4px_rgba(0,0,0,0.03)]
              focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-100/50
              disabled:opacity-50 disabled:cursor-not-allowed
              resize-none'
]) !!}>{{ $slot }}</textarea>
