@props(['label' => null])

<label class="inline-flex cursor-pointer items-center gap-3">
    <div class="relative">
        <input type="checkbox" class="peer sr-only" {{ $attributes }}>
        <div class="h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-primary-600 peer-focus:ring-2 peer-focus:ring-primary-500/20 dark:bg-gray-600"></div>
        <div class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white transition peer-checked:translate-x-5 shadow-sm"></div>
    </div>
    @if($label)
    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
</label>