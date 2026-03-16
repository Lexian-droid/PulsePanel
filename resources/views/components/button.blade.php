@props([
'variant' => 'primary',
'size' => 'md',
'href' => null,
'type' => 'button',
])

@php
$variants = [
'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500 shadow-sm',
'secondary' => 'bg-white text-gray-700 hover:bg-gray-50 focus:ring-primary-500 shadow-sm ring-1 ring-gray-300 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700',
'danger' => 'bg-danger-600 text-white hover:bg-danger-500 focus:ring-danger-500 shadow-sm',
'success' => 'bg-success-600 text-white hover:bg-success-500 focus:ring-success-500 shadow-sm',
'ghost' => 'text-gray-700 hover:bg-gray-100 focus:ring-primary-500 dark:text-gray-300 dark:hover:bg-gray-700',
];

$sizes = [
'sm' => 'px-3 py-1.5 text-xs',
'md' => 'px-4 py-2 text-sm',
'lg' => 'px-5 py-2.5 text-base',
];

$classes = 'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed '
. ($variants[$variant] ?? $variants['primary']) . ' '
. ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif