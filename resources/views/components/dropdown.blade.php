@props(['align' => 'right', 'width' => '48'])

@php
$originClass = match ($align) {
'left' => 'origin-top-left',
default => 'origin-top-right',
};

$widthClass = match ($width) {
'48' => 'w-48',
'56' => 'w-56',
'64' => 'w-64',
default => 'w-48',
};
@endphp

<div
    x-data="{
        open: false,
        align: '{{ $align }}',
        x: 0,
        y: 0,
        reposition() {
            const rect = this.$refs.trigger.getBoundingClientRect();
            this.y = rect.bottom + window.scrollY + 8;
            if (this.align === 'left') {
                this.x = rect.left + window.scrollX;
            } else {
                this.x = rect.right + window.scrollX;
            }
        }
    }"
    class="relative inline-block text-left"
    {{ $attributes }}>
    <div x-ref="trigger" @click="reposition(); open = !open">
        {{ $trigger }}
    </div>

    <template x-teleport="body">
        <div
            x-show="open"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            :style="align === 'left'
                ? `position:absolute; top:${y}px; left:${x}px;`
                : `position:absolute; top:${y}px; left:${x}px; transform: translateX(-100%);`"
            class="{{ $widthClass }} {{ $originClass }} z-[9999] rounded-lg bg-white py-1 shadow-lg ring-1 ring-black/5 dark:bg-gray-800 dark:ring-white/10"
            x-cloak>
            {{ $slot }}
        </div>
    </template>
</div>