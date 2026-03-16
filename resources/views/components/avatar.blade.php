@props([
'name' => '',
'size' => 'md',
'src' => null,
])

@php
$sizes = [
'xs' => 'h-6 w-6 text-xs',
'sm' => 'h-8 w-8 text-xs',
'md' => 'h-10 w-10 text-sm',
'lg' => 'h-12 w-12 text-base',
'xl' => 'h-16 w-16 text-lg',
];

$initials = collect(explode(' ', $name))->map(fn ($word) => mb_substr($word, 0, 1))->take(2)->implode('');
@endphp

@if($src)
<img src="{{ $src }}" alt="{{ $name }}" {{ $attributes->merge(['class' => 'rounded-full object-cover ' . ($sizes[$size] ?? $sizes['md'])]) }}>
@else
<span {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-full bg-primary-100 font-medium text-primary-700 dark:bg-primary-900/30 dark:text-primary-400 ' . ($sizes[$size] ?? $sizes['md'])]) }}>
    {{ strtoupper($initials) }}
</span>
@endif