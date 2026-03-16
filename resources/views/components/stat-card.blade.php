@props([
'label',
'value',
'change' => null,
'changeType' => 'up',
'icon' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10']) }}>
    <div class="flex items-center justify-between">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</p>
        @if($icon)
        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400">
            <x-dynamic-component :component="'icon.' . $icon" class="h-5 w-5" />
        </span>
        @endif
    </div>
    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $value }}</p>
    @if($change)
    <p class="mt-2 flex items-center gap-1 text-sm">
        @if($changeType === 'up')
        <svg class="h-4 w-4 text-success-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
        </svg>
        <span class="text-success-600 dark:text-success-500">{{ $change }}</span>
        @else
        <svg class="h-4 w-4 text-danger-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
        </svg>
        <span class="text-danger-600 dark:text-danger-500">{{ $change }}</span>
        @endif
        <span class="text-gray-400">vs last period</span>
    </p>
    @endif
</div>