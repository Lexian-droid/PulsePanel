@props(['gap' => 4])

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
default => 'gap-4',
};
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col {$gapClass}"]) }}>
    {{ $slot }}
</div>