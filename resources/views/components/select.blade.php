@props(['options' => [], 'placeholder' => null])

<select {{ $attributes->merge([
    'class' => 'block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500'
]) }}>
    @if($placeholder)
    <option value="">{{ $placeholder }}</option>
    @endif
    @foreach($options as $value => $label)
    <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
    {{ $slot }}
</select>