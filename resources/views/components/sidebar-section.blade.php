@props(['label'])

<div class="pt-4 first:pt-0">
    <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-gray-400">{{ $label }}</p>
    {{ $slot }}
</div>