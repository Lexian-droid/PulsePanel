@props(['title' => null])

<div {{ $attributes->merge(['class' => 'rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10']) }}>
    @if($title)
    <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-700">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
    </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>