@if($visible)
<div wire:transition class="flex items-start gap-3 rounded-lg border p-4
    @if($type === 'success') bg-success-50 text-green-800 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800
    @elseif($type === 'warning') bg-warning-50 text-yellow-800 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800
    @elseif($type === 'danger') bg-danger-50 text-red-800 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800
    @else bg-primary-50 text-primary-800 border-primary-200 dark:bg-primary-900/30 dark:text-primary-300 dark:border-primary-800
    @endif
">
    <div class="flex-1 text-sm">{{ $message }}</div>
    <button wire:click="dismiss" class="shrink-0 opacity-50 hover:opacity-100">
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
</div>
@endif