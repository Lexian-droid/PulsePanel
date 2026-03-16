@props(['name'])

<button @click="activeTab = '{{ $name }}'"
    :class="activeTab === '{{ $name }}'
            ? 'border-primary-500 text-primary-600 dark:text-primary-400'
            : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
    {{ $attributes->merge(['class' => 'whitespace-nowrap border-b-2 px-1 py-3 text-sm font-medium transition']) }}>
    {{ $slot }}
</button>