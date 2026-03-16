@props(['label' => null, 'error' => null, 'hint' => null, 'required' => false])

<div {{ $attributes->merge(['class' => 'space-y-1.5']) }}>
    @if($label)
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if($required)
        <span class="text-danger-500">*</span>
        @endif
    </label>
    @endif

    {{ $slot }}

    @if($hint && !$error)
    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif

    @if($error)
    <p class="text-xs text-danger-600 dark:text-danger-400">{{ $error }}</p>
    @endif
</div>