@props(['route', 'icon', 'color' => 'red'])

@php
    // Definisikan warna hover-nya
    $activeClass = match ($color) {
        'yellow' => 'bg-yellow-600 text-white shadow-xs',
        'blue' => 'bg-blue-600 text-white shadow-xs',
        default => 'bg-red-600 text-white shadow-xs',
    };

    $iconHoverClass = match ($color) {
        'yellow' => 'group-hover:text-yellow-500',
        'blue' => 'group-hover:text-blue-400',
        default => 'group-hover:text-red-500',
    };
@endphp

<a href="{{ route($route) }}"
    class="flex items-center space-x-3 px-3 py-2 text-[11px] font-semibold rounded-lg transition duration-200 group
    {{ request()->routeIs($route) ? $activeClass : 'text-slate-400 hover:bg-slate-900 hover:text-slate-100' }}">

    <i
        class="{{ $icon }} text-sm w-5 text-center {{ request()->routeIs($route) ? 'text-white' : 'text-slate-500 ' . $iconHoverClass . ' transition' }}"></i>

    <span>{{ $slot }}</span>
</a>
