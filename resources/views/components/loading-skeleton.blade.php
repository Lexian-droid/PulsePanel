@props(['rows' => 5, 'cols' => 4])

<div {{ $attributes->merge(['class' => 'animate-pulse']) }}>
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10">
        {{-- Header --}}
        <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900/50">
            <div class="flex gap-4">
                @for($c = 0; $c < $cols; $c++)
                    <div class="h-3 flex-1 rounded bg-gray-200 dark:bg-gray-700">
            </div>
            @endfor
        </div>
    </div>
    {{-- Rows --}}
    @for($r = 0; $r < $rows; $r++)
        <div class="border-b border-gray-200 px-4 py-3 last:border-b-0 dark:border-gray-700">
        <div class="flex gap-4">
            @for($c = 0; $c < $cols; $c++)
                <div class="h-3 flex-1 rounded bg-gray-100 dark:bg-gray-700/50">
        </div>
        @endfor
</div>
</div>
@endfor
</div>
</div>