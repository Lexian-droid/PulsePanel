<x-content-container>
    <x-page-header subtitle="Manage your teams and team members.">
        Teams
    </x-page-header>

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

    @if($canCreateTeams)
    <x-card class="mb-6">
        <form wire:submit="createTeam" class="space-y-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Team Name</label>
                <x-input wire:model="name" placeholder="Acme Ops" />
                @error('name')
                <p class="mt-1 text-xs text-danger-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <x-textarea wire:model="description" rows="2" placeholder="What this team is responsible for." />
                @error('description')
                <p class="mt-1 text-xs text-danger-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <x-button variant="primary" type="submit">Create Team</x-button>
            </div>
        </form>
    </x-card>
    @endif

    @if($myInvitations->isNotEmpty())
    <x-card class="mb-6">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Invitations For You</h3>
        <div class="mt-3 space-y-3">
            @foreach($myInvitations as $invitation)
            <div class="flex flex-col gap-3 rounded-lg border border-gray-200 p-3 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $invitation->team->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Role: {{ Str::headline($invitation->role) }}</p>
                </div>
                <div class="flex gap-2">
                    <x-button size="sm" variant="success" wire:click="acceptInvitation({{ $invitation->id }})">Accept</x-button>
                    <x-button size="sm" variant="secondary" wire:click="declineInvitation({{ $invitation->id }})">Decline</x-button>
                </div>
            </div>
            @endforeach
        </div>
    </x-card>
    @endif

    @if($teams->isEmpty())
    <x-empty-state>
        <x-slot:title>No teams yet</x-slot:title>
        <x-slot:description>You're not a member of any teams. Teams can be created to organize users, projects, and resources.</x-slot:description>
    </x-empty-state>
    @else
    <x-grid cols="3">
        @foreach($teams as $team)
        <x-card>
            <div class="space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $team->name }}</h3>
                        @if($team->pending_invitations_count > 0)
                        <x-badge color="warning">{{ $team->pending_invitations_count }} Pending</x-badge>
                        @endif
                    </div>
                    @if($team->owner)
                    <p class="text-xs text-gray-500 dark:text-gray-400">Owner: {{ $team->owner->name }}</p>
                    @endif
                </div>
                @if($team->description)
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $team->description }}</p>
                @endif
                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $team->users_count }} {{ Str::plural('member', $team->users_count) }}</p>

                <div class="space-y-2 border-t border-gray-200 pt-3 dark:border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Members</h4>
                    @foreach($team->users as $member)
                    <div class="flex flex-col gap-2 rounded-lg border border-gray-200 p-2 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between" wire:key="team-{{ $team->id }}-member-{{ $member->id }}">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $member->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $member->email }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($team->can_be_managed)
                            <x-select wire:change="updateMemberRole({{ $team->id }}, {{ $member->id }}, $event.target.value)">
                                @foreach($teamRoleOptions as $value => $label)
                                <option value="{{ $value }}" @selected($member->pivot->role === $value)>{{ $label }}</option>
                                @endforeach
                            </x-select>
                            @else
                            <x-badge color="gray">{{ Str::headline($member->pivot->role) }}</x-badge>
                            @endif

                            @if($team->can_be_managed && $member->id !== auth()->id() && $team->owner_id !== $member->id)
                            <x-button size="sm" variant="ghost" wire:click="removeMember({{ $team->id }}, {{ $member->id }})">Remove</x-button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($team->can_be_managed)
                <div class="space-y-3 border-t border-gray-200 pt-3 dark:border-gray-700">
                    @if($inviteTeamId !== $team->id)
                    <x-button size="sm" variant="secondary" wire:click="startInvite({{ $team->id }})">Invite Member</x-button>
                    @else
                    <div class="space-y-2">
                        <div>
                            <label class="mb-1 block text-xs font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <x-input wire:model="inviteEmail" type="email" placeholder="teammate@example.com" />
                            @error('inviteEmail')
                            <p class="mt-1 text-xs text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <x-select wire:model="inviteRole">
                                @foreach($teamRoleOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </x-select>
                            @error('inviteRole')
                            <p class="mt-1 text-xs text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-2">
                            <x-button size="sm" variant="primary" wire:click="sendInvite">Send Invite</x-button>
                            <x-button size="sm" variant="secondary" wire:click="cancelInvite">Cancel</x-button>
                        </div>
                    </div>
                    @endif

                    @if($team->pendingInvitations->isNotEmpty())
                    <div class="space-y-2">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Pending Invites</p>
                        @foreach($team->pendingInvitations as $pending)
                        <div class="flex items-center justify-between gap-2 rounded-lg bg-gray-50 px-3 py-2 text-xs text-gray-700 dark:bg-gray-700/40 dark:text-gray-200" wire:key="pending-invite-{{ $pending->id }}">
                            <span>{{ $pending->email }} · {{ Str::headline($pending->role) }}</span>
                            <x-button size="sm" variant="ghost" wire:click="cancelInvitation({{ $pending->id }})">Cancel</x-button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </x-card>
        @endforeach
    </x-grid>
    @endif
</x-content-container>