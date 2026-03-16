@props([
'type' => 'info',
'dismissible' => false,
])

@php
$styles = [
'info' => 'bg-primary-50 text-primary-800 border-primary-200 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-800',
'success' => 'bg-success-50 text-green-800 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
'warning' => 'bg-warning-50 text-yellow-800 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800',
'danger' => 'bg-danger-50 text-red-800 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-start gap-3 rounded-lg border p-4 ' . ($styles[$type] ?? $styles['info'])]) }}
    @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif>
    <div class="flex-1 text-sm">{{ $slot }}</div>
    @if($dismissible)
    <button @click="show = false" class="shrink-0 opacity-50 hover:opacity-100">
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    @endif
</div>