@props(['padding' => true])

<div {{ $attributes->merge(['class' => 'rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10' . ($padding ? ' p-6' : '')]) }}>
    @if(isset($header))
    <div class="mb-4 border-b border-gray-100 pb-4 dark:border-gray-700">
        {{ $header }}
    </div>
    @endif

    {{ $slot }}

    @if(isset($footer))
    <div class="mt-4 border-t border-gray-100 pt-4 dark:border-gray-700">
        {{ $footer }}
    </div>
    @endif
</div>