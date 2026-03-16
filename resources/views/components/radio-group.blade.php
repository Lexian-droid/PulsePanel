@props(['options' => [], 'name'])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @foreach($options as $value => $label)
    <label class="inline-flex items-center gap-2">
        <input type="radio" name="{{ $name }}" value="{{ $value }}"
            class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $label }}</span>
    </label>
    @endforeach
</div>