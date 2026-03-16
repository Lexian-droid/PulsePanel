@props(['items' => []])

<div {{ $attributes->merge(['class' => 'flow-root']) }}>
    <ul class="-mb-4">
        @foreach($items as $item)
        <li class="relative pb-4">
            @if(!$loop->last)
            <span class="absolute left-4 top-8 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"></span>
            @endif
            <div class="relative flex items-start gap-3">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $item['color'] ?? 'bg-primary-100 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' }} ring-4 ring-white dark:ring-gray-800">
                    @if(isset($item['icon']))
                    <x-dynamic-component :component="'icon.' . $item['icon']" class="h-4 w-4" />
                    @else
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4" />
                    </svg>
                    @endif
                </span>
                <div class="min-w-0 flex-1">
                    <p class="text-sm text-gray-900 dark:text-white">{{ $item['title'] }}</p>
                    @if(isset($item['description']))
                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $item['description'] }}</p>
                    @endif
                    @if(isset($item['time']))
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $item['time'] }}</p>
                    @endif
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>