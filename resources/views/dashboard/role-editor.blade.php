<x-content-container>
    <x-page-header subtitle="Manage user roles and permissions.">
        Role Editor
    </x-page-header>

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="mb-6">
        <livewire:dismissible-alert type="success" :message="session('success')" />
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6">
        <livewire:dismissible-alert type="danger" :message="session('error')" />
    </div>
    @endif

    {{-- Filters --}}
    <x-card class="mb-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="w-full sm:max-w-xs">
                <x-search-input wire:model.live.debounce.300ms="search" placeholder="Search users..." />
            </div>
            <div class="w-full sm:max-w-xs">
                <select wire:model.live="filterRole"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500">
                    <option value="">All Roles</option>
                    @foreach($allRoles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-card>

    {{-- Users table --}}
    <x-table>
        <x-slot:head>
            <tr>
                <x-th>User</x-th>
                <x-th>Role</x-th>
                <x-th>Level</x-th>
                <x-th class="text-right">Actions</x-th>
            </tr>
        </x-slot:head>

        @forelse($users as $user)
        <tr wire:key="user-{{ $user->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
            <x-td>
                <div class="flex items-center gap-3">
                    <x-avatar :name="$user->name" size="sm" />
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                    </div>
                </div>
            </x-td>
            <x-td>
                @php $roleName = $user->roles->first()?->name ?? 'none'; @endphp
                <x-badge :color="match($roleName) {
                    'owner' => 'danger',
                    'admin' => 'warning',
                    'moderator' => 'primary',
                    'member' => 'success',
                    default => 'gray',
                }">
                    {{ ucfirst($roleName) }}
                </x-badge>
            </x-td>
            <x-td>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $hierarchy[$roleName] ?? 0 }}
                </span>
            </x-td>
            <x-td class="text-right">
                @if(auth()->user()->can('manage-role', $user) && auth()->id() !== $user->id)
                <x-button variant="ghost" size="sm" wire:click="editUser({{ $user->id }})">
                    Edit Role
                </x-button>
                @elseif(auth()->id() === $user->id)
                <span class="text-xs text-gray-400 dark:text-gray-500">You</span>
                @else
                <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                @endif
            </x-td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                <x-empty-state title="No users found" description="Try adjusting your search or role filter." />
            </td>
        </tr>
        @endforelse
    </x-table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

    {{-- Edit role modal --}}
    @if($editingUserId)
    @php $editingUser = $users->firstWhere('id', $editingUserId); @endphp
    <div class="fixed inset-0 z-50 overflow-y-auto" x-data x-transition>
        <div class="fixed inset-0 bg-black/50" wire:click="cancelEdit"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-sm rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800" @click.stop>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Role</h3>
                @if($editingUser)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Change role for <span class="font-medium text-gray-900 dark:text-white">{{ $editingUser->name }}</span>
                </p>
                @endif

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    <select wire:model="selectedRole"
                        class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500">
                        <option value="">Select a role...</option>
                        @foreach($assignableRoles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }} (Level {{ $hierarchy[$role] ?? 0 }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-button variant="secondary" wire:click="cancelEdit">Cancel</x-button>
                    <x-button variant="primary" wire:click="updateRole" :disabled="!$selectedRole">Save</x-button>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-content-container>