<?php

use App\Livewire\Pages\Teams;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleAndPermissionSeeder::class);
    $this->withoutVite();
});

it('does not allow users without permission to create teams', function () {
    $member = User::factory()->create();
    $member->assignRole('member');

    Livewire::actingAs($member)
        ->test(Teams::class)
        ->set('name', 'Restricted Team')
        ->set('description', 'Should not be created')
        ->call('createTeam');

    expect(Team::query()->where('name', 'Restricted Team')->exists())->toBeFalse();
});

it('allows users with manage teams permission to create a team', function () {
    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    Livewire::actingAs($moderator)
        ->test(Teams::class)
        ->set('name', 'Operations')
        ->set('description', 'Ops and support')
        ->call('createTeam');

    $team = Team::query()->where('name', 'Operations')->first();

    expect($team)->not->toBeNull();
    expect($team->owner_id)->toBe($moderator->id);
    expect($team->users()->where('users.id', $moderator->id)->first()->pivot->role)->toBe('owner');
});

it('creates a pending invitation for non-member emails', function () {
    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $team = Team::factory()->create(['owner_id' => $moderator->id]);
    $team->users()->attach($moderator->id, ['role' => 'owner']);

    Livewire::actingAs($moderator)
        ->test(Teams::class)
        ->set('inviteTeamId', $team->id)
        ->set('inviteEmail', 'new.user@example.com')
        ->set('inviteRole', 'member')
        ->call('sendInvite');

    expect(TeamInvitation::query()->where('team_id', $team->id)->where('email', 'new.user@example.com')->pending()->exists())->toBeTrue();
});

it('allows a user to accept their team invitation', function () {
    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $invitee = User::factory()->create(['email' => 'invitee@example.com']);
    $invitee->assignRole('member');

    $team = Team::factory()->create(['owner_id' => $moderator->id]);
    $team->users()->attach($moderator->id, ['role' => 'owner']);

    $invitation = TeamInvitation::query()->create([
        'team_id' => $team->id,
        'invited_by' => $moderator->id,
        'email' => $invitee->email,
        'role' => 'member',
        'token' => 'fixed-token-for-test',
        'expires_at' => now()->addDay(),
    ]);

    Livewire::actingAs($invitee)
        ->test(Teams::class)
        ->call('acceptInvitation', $invitation->id);

    expect($team->users()->where('users.id', $invitee->id)->exists())->toBeTrue();
    expect($invitation->fresh()->accepted_at)->not->toBeNull();
});

it('allows a team manager to update a member role', function () {
    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $member = User::factory()->create();
    $member->assignRole('member');

    $team = Team::factory()->create(['owner_id' => $moderator->id]);
    $team->users()->attach($moderator->id, ['role' => 'owner']);
    $team->users()->attach($member->id, ['role' => 'member']);

    Livewire::actingAs($moderator)
        ->test(Teams::class)
        ->call('updateMemberRole', $team->id, $member->id, 'admin');

    expect($team->users()->where('users.id', $member->id)->first()->pivot->role)->toBe('admin');
});
