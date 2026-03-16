@props(['align' => 'right', 'width' => '48'])

@php
$alignClasses = match ($align) {
'left' => 'left-0 origin-top-left',
default => 'right-0 origin-top-right',
};

$widthClass = match ($width) {
'48' => 'w-48',
'56' => 'w-56',
'64' => 'w-64',
default => 'w-48',
};
@endphp

<div x-data="{ open: false }" class="relative inline-block text-left" {{ $attributes }}>
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div x-show="open" @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute {{ $alignClasses }} {{ $widthClass }} z-50 mt-2 rounded-lg bg-white py-1 shadow-lg ring-1 ring-black/5 dark:bg-gray-800 dark:ring-white/10"
        x-cloak>
        {{ $slot }}
    </div>
</div>