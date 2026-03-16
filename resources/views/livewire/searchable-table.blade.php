<div>
    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full sm:max-w-xs">
            <x-search-input wire:model.live.debounce.300ms="search" placeholder="Search users..." />
        </div>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <x-th>
                    <button wire:click="sortBy('name')" class="flex items-center gap-1 hover:text-gray-700 dark:hover:text-gray-200">
                        Name
                        @if($sortField === 'name')
                        <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            @if($sortDirection === 'asc')
                            <path d="M12 4l-8 8h16z" />
                            @else
                            <path d="M12 20l-8-8h16z" />
                            @endif
                        </svg>
                        @endif
                    </button>
                </x-th>
                <x-th>
                    <button wire:click="sortBy('email')" class="flex items-center gap-1 hover:text-gray-700 dark:hover:text-gray-200">
                        Email
                        @if($sortField === 'email')
                        <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            @if($sortDirection === 'asc')
                            <path d="M12 4l-8 8h16z" />
                            @else
                            <path d="M12 20l-8-8h16z" />
                            @endif
                        </svg>
                        @endif
                    </button>
                </x-th>
                <x-th>Joined</x-th>
                <x-th>Status</x-th>
            </tr>
        </x-slot:head>

        @forelse($users as $user)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
            <x-td>
                <div class="flex items-center gap-3">
                    <x-avatar :name="$user->name" size="sm" />
                    <span class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                </div>
            </x-td>
            <x-td>{{ $user->email }}</x-td>
            <x-td>{{ $user->created_at->format('M d, Y') }}</x-td>
            <x-td>
                <x-badge color="success">Active</x-badge>
            </x-td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                <x-empty-state title="No users found" description="Try a different search term." />
            </td>
        </tr>
        @endforelse
    </x-table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>