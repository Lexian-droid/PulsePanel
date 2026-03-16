@if($show)
<div class="fixed inset-0 z-50 overflow-y-auto" x-transition>
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black/50" wire:click="cancel"></div>

    {{-- Panel --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-sm rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800" @click.stop>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $message }}</p>

            <div class="mt-6 flex justify-end gap-3">
                <x-button variant="secondary" wire:click="cancel">{{ $cancelText }}</x-button>
                <x-button variant="danger" wire:click="confirm">{{ $confirmText }}</x-button>
            </div>
        </div>
    </div>
</div>
@endif