@props(['items' => []])

@if(count($items))
<nav class="mb-4">
    <ol class="flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
        <li>
            <a href="{{ route('dashboard') }}" wire:navigate class="hover:text-gray-700 dark:hover:text-gray-200">Dashboard</a>
        </li>
        @foreach($items as $label => $url)
        <li class="flex items-center gap-1.5">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            @if($url)
            <a href="{{ $url }}" wire:navigate class="hover:text-gray-700 dark:hover:text-gray-200">{{ $label }}</a>
            @else
            <span class="text-gray-900 dark:text-gray-100">{{ $label }}</span>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
@endif