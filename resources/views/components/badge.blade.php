@props([
'color' => 'gray',
'size' => 'md',
])

@php
$colors = [
'gray' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
'primary' => 'bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400',
'success' => 'bg-success-50 text-success-600 dark:bg-green-900/30 dark:text-green-400',
'warning' => 'bg-warning-50 text-warning-600 dark:bg-yellow-900/30 dark:text-yellow-400',
'danger' => 'bg-danger-50 text-danger-600 dark:bg-red-900/30 dark:text-red-400',
];

$sizes = [
'sm' => 'px-2 py-0.5 text-xs',
'md' => 'px-2.5 py-1 text-xs',
'lg' => 'px-3 py-1 text-sm',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full font-medium ' . ($colors[$color] ?? $colors['gray']) . ' ' . ($sizes[$size] ?? $sizes['md'])]) }}>
    {{ $slot }}
</span>