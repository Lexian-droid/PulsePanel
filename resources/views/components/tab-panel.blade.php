@props(['name'])

<div x-show="activeTab === '{{ $name }}'" x-transition {{ $attributes }}>
    {{ $slot }}
</div>