@props(['cols' => 2, 'gap' => 6])

@php
$gridCols = match ((int) $cols) {
1 => 'grid-cols-1',
2 => 'grid-cols-1 lg:grid-cols-2',
3 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
default => 'grid-cols-1 lg:grid-cols-2',
};
@endphp

@php
$gapClass = match ((int) $gap) {
1 => 'gap-1',
2 => 'gap-2',
3 => 'gap-3',
4 => 'gap-4',
5 => 'gap-5',
6 => 'gap-6',
8 => 'gap-8',
10 => 'gap-10',
12 => 'gap-12',
default => 'gap-6',
};
@endphp

<div {{ $attributes->merge(['class' => "grid {$gapClass} {$gridCols}"]) }}>
    {{ $slot }}
</div>