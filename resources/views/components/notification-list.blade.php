@props(['notifications' => []])

<div {{ $attributes->merge(['class' => 'divide-y divide-gray-100 dark:divide-gray-700']) }}>
    @forelse($notifications as $notification)
    <div class="flex items-start gap-3 px-4 py-3 {{ ($notification['unread'] ?? false) ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }}">
        <x-avatar :name="$notification['from'] ?? 'System'" size="sm" />
        <div class="min-w-0 flex-1">
            <p class="text-sm text-gray-900 dark:text-white">{{ $notification['message'] }}</p>
            <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $notification['time'] ?? '' }}</p>
        </div>
        @if($notification['unread'] ?? false)
        <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-primary-500"></span>
        @endif
    </div>
    @empty
    <x-empty-state title="No notifications" description="You're all caught up!" />
    @endforelse
</div>