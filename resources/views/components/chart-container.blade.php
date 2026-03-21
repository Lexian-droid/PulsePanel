@props(['height' => '300px', 'label' => 'Chart', 'config' => null])

<div {{ $attributes->merge(['class' => 'rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10']) }}>
    @if($label)
    <h3 class="mb-4 text-sm font-semibold text-gray-900 dark:text-white">{{ $label }}</h3>
    @endif

    @if($config)
    <div x-data="{
        chart: null,
        init() {
            const ctx = this.$refs.canvas.getContext('2d');
            this.chart = new Chart(ctx, {{ Js::from($config) }});
        },
        destroy() {
            if (this.chart) this.chart.destroy();
        }
    }" @style(["height: {$height}"])>
        <canvas x-ref="canvas" class="h-full! w-full!"></canvas>
    </div>
    @elseif(isset($slot) && (string) $slot !== '')
    <div @style(["height: {$height}"])>
        {{ $slot }}
    </div>
    @else
    <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-gray-200 dark:border-gray-700" @style(["height: {$height}"])>
        <div class="text-center">
            <svg class="mx-auto h-10 w-10 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <p class="mt-2 text-sm text-gray-400 dark:text-gray-500">Chart placeholder</p>
            <p class="text-xs text-gray-300 dark:text-gray-600">Integrate your preferred charting library</p>
        </div>
    </div>
    @endif
</div>