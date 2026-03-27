<?php

namespace App\Livewire\Pages;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Teams', 'breadcrumbs' => ['Teams' => null]])]
class Teams extends Component
{
    public string $name = '';

    public string $description = '';

    public ?int $inviteTeamId = null;

    public string $inviteEmail = '';

    public string $inviteRole = 'member';

    /**
     * @var list<string>
     */
    protected array $teamRoles = ['owner', 'admin', 'member'];

    public function createTeam(): void
    {
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->can('create-team')) {
            session()->flash('error', 'You do not have permission to create teams.');

            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $team = Team::query()->create([
            'owner_id' => $currentUser->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?: null,
        ]);

        $team->users()->attach($currentUser->id, ['role' => 'owner']);

        $this->reset('name', 'description');

        session()->flash('success', "Created team {$team->name}.");
    }

    public function startInvite(int $teamId): void
    {
        $team = Team::query()->findOrFail($teamId);
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->can('manage-team', $team)) {
            session()->flash('error', 'You do not have permission to invite members to this team.');

            return;
        }

        $this->inviteTeamId = $teamId;
        $this->inviteEmail = '';
        $this->inviteRole = 'member';
    }

    public function cancelInvite(): void
    {
        $this->reset('inviteTeamId', 'inviteEmail', 'inviteRole');
        $this->inviteRole = 'member';
    }

    public function sendInvite(): void
    {
        if (! $this->inviteTeamId) {
            session()->flash('error', 'Select a team to invite a member.');

            return;
        }

        $team = Team::query()->findOrFail($this->inviteTeamId);
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->can('manage-team', $team)) {
            session()->flash('error', 'You do not have permission to invite members to this team.');

            return;
        }

        $validated = $this->validate([
            'inviteEmail' => ['required', 'email', 'max:255'],
            'inviteRole' => ['required', Rule::in($this->teamRoles)],
        ]);

        $email = Str::lower($validated['inviteEmail']);
        $role = $validated['inviteRole'];

        $existingUser = User::query()->where('email', $email)->first();

        if ($existingUser) {
            if ($team->users()->where('users.id', $existingUser->id)->exists()) {
                session()->flash('error', 'That user is already a member of this team.');

                return;
            }

            $team->users()->attach($existingUser->id, ['role' => $role]);

            $this->cancelInvite();
            session()->flash('success', "Added {$existingUser->name} to {$team->name}.");

            return;
        }

        TeamInvitation::query()
            ->where('team_id', $team->id)
            ->where('email', $email)
            ->pending()
            ->update(['cancelled_at' => now()]);

        TeamInvitation::query()->create([
            'team_id' => $team->id,
            'invited_by' => $currentUser->id,
            'email' => $email,
            'role' => $role,
            'token' => Str::random(40),
            'expires_at' => now()->addDays(7),
        ]);

        $this->cancelInvite();
        session()->flash('success', "Invitation sent to {$email} for {$team->name}.");
    }

    public function updateMemberRole(int $teamId, int $userId, string $role): void
    {
        $team = Team::query()->with('users')->findOrFail($teamId);
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->can('manage-team', $team)) {
            session()->flash('error', 'You do not have permission to manage this team.');

            return;
        }

        if (! in_array($role, $this->teamRoles, true)) {
            session()->flash('error', 'Invalid team role selected.');

            return;
        }

        $member = $team->users->firstWhere('id', $userId);

        if (! $member) {
            session()->flash('error', 'The selected team member was not found.');

            return;
        }

        $actingUserId = $currentUser->id;

        if ($member->id === $actingUserId && $role !== 'owner') {
            session()->flash('error', 'You cannot demote yourself from owner in this screen.');

            return;
        }

        if ($role === 'owner' && $team->owner_id !== $actingUserId) {
            session()->flash('error', 'Only the current owner can transfer ownership.');

            return;
        }

        if ($role === 'owner') {
            $team->users()->updateExistingPivot($actingUserId, ['role' => 'admin']);
            $team->owner_id = $member->id;
            $team->save();
        }

        $team->users()->updateExistingPivot($member->id, ['role' => $role]);

        session()->flash('success', "Updated {$member->name}'s team role to {$role}.");
    }

    public function removeMember(int $teamId, int $userId): void
    {
        $team = Team::query()->with('users')->findOrFail($teamId);
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->can('manage-team', $team)) {
            session()->flash('error', 'You do not have permission to manage this team.');

            return;
        }

        if ($team->owner_id === $userId) {
            session()->flash('error', 'Transfer ownership before removing the owner.');

            return;
        }

        if ($userId === $currentUser->id) {
            session()->flash('error', 'You cannot remove yourself from this screen.');

            return;
        }

        $member = $team->users->firstWhere('id', $userId);

        if (! $member) {
            session()->flash('error', 'The selected team member was not found.');

            return;
        }

        $team->users()->detach($member->id);

        session()->flash('success', "Removed {$member->name} from {$team->name}.");
    }

    public function cancelInvitation(int $invitationId): void
    {
        $invitation = TeamInvitation::query()->with('team')->findOrFail($invitationId);
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->can('manage-team', $invitation->team)) {
            session()->flash('error', 'You do not have permission to cancel this invitation.');

            return;
        }

        if ($invitation->accepted_at || $invitation->cancelled_at) {
            return;
        }

        $invitation->update(['cancelled_at' => now()]);

        session()->flash('success', 'Invitation cancelled.');
    }

    public function acceptInvitation(int $invitationId): void
    {
        $currentUser = Auth::user();

        if (! $currentUser) {
            abort(403);
        }

        $invitation = TeamInvitation::query()
            ->with('team')
            ->where('email', $currentUser->email)
            ->pending()
            ->findOrFail($invitationId);

        if ($invitation->team->users()->where('users.id', $currentUser->id)->exists()) {
            $invitation->update(['accepted_at' => now()]);
            session()->flash('success', "You're already in {$invitation->team->name}.");

            return;
        }

        $invitation->team->users()->attach($currentUser->id, ['role' => $invitation->role]);
        $invitation->update(['accepted_at' => now()]);

        session()->flash('success', "You joined {$invitation->team->name}.");
    }

    public function declineInvitation(int $invitationId): void
    {
        $currentUser = Auth::user();

        if (! $currentUser) {
            abort(403);
        }

        $invitation = TeamInvitation::query()
            ->where('email', $currentUser->email)
            ->pending()
            ->findOrFail($invitationId);

        $invitation->update(['cancelled_at' => now()]);

        session()->flash('success', 'Invitation declined.');
    }

    public function render(): View
    {
        $currentUser = Auth::user();

        if (! $currentUser) {
            abort(403);
        }

        /** @var User $currentUser */
        $teams = $currentUser->teams()
            ->with('owner:id,name')
            ->with(['users' => function ($query) {
                $query->select('users.id', 'users.name', 'users.email')->orderBy('name');
            }])
            ->with(['pendingInvitations' => function ($query) {
                $query->latest();
            }])
            ->withCount('users')
            ->withCount(['pendingInvitations as pending_invitations_count'])
            ->orderBy('name')
            ->get();

        $teams->each(function (Team $team): void {
            $team->setAttribute('can_be_managed', Auth::user()?->can('manage-team', $team) ?? false);
        });

        $myInvitations = TeamInvitation::query()
            ->with('team:id,name')
            ->where('email', $currentUser->email)
            ->pending()
            ->latest()
            ->get();

        $teamRoleOptions = collect($this->teamRoles)
            ->mapWithKeys(fn(string $role) => [$role => Str::headline($role)]);

        return view('dashboard.teams', [
            'teams' => $teams,
            'myInvitations' => $myInvitations,
            'teamRoleOptions' => $teamRoleOptions,
            'canCreateTeams' => $currentUser->can('create-team'),
        ]);
    }
}
