@props(['href', 'active' => false, 'icon' => null])

@php
$classes = $active
? 'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-white bg-sidebar-active'
: 'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors';
@endphp

<a href="{{ $href }}" wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
    <x-dynamic-component :component="'icon.' . $icon" class="h-5 w-5 shrink-0" />
    @endif
    <span>{{ $slot }}</span>
</a>