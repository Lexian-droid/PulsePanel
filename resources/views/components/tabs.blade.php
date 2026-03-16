@props(['active' => null])

<div x-data="{ activeTab: '{{ $active ?? '' }}' }" {{ $attributes }}>
    {{-- Tab buttons --}}
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex gap-4">
            {{ $tabs }}
        </nav>
    </div>

    {{-- Tab panels --}}
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>