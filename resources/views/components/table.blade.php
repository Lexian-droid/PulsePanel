@props(['striped' => false])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10']) }}>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 {{ $striped ? '[&_tbody_tr:nth-child(even)]:bg-gray-50 dark:[&_tbody_tr:nth-child(even)]:bg-gray-900/50' : '' }}">
            @if(isset($head))
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                {{ $head }}
            </thead>
            @endif
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>