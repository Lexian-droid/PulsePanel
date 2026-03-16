@props(['label' => null])

<label class="inline-flex items-center gap-2">
    <input type="checkbox" {{ $attributes->merge([
        'class' => 'h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700'
    ]) }}>
    @if($label)
    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
</label>