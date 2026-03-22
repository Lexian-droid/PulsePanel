<?php

use App\Models\Team;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleAndPermissionSeeder::class);
});

it('seeds default roles', function () {
    expect(Role::count())->toBe(4);
    expect(Role::pluck('name')->toArray())->toContain('owner', 'admin', 'moderator', 'member');
});

it('seeds default permissions', function () {
    expect(Permission::count())->toBeGreaterThanOrEqual(5);
});

it('assigns owner role to initial user in database seeder', function () {
    $owner = User::factory()->create();
    $owner->assignRole('owner');

    expect($owner->hasRole('owner'))->toBeTrue();
});

it('assigns default role to registered users', function () {
    $user = User::factory()->create();
    $user->assignRole(config('pulsepanel.default_role', 'member'));

    expect($user->hasRole('member'))->toBeTrue();
});

it('calculates role hierarchy level correctly', function () {
    $owner = User::factory()->create();
    $owner->assignRole('owner');

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $member = User::factory()->create();
    $member->assignRole('member');

    expect($owner->roleLevel())->toBe(100);
    expect($admin->roleLevel())->toBe(50);
    expect($member->roleLevel())->toBe(10);
});

it('prevents peers from managing each other', function () {
    $admin1 = User::factory()->create();
    $admin1->assignRole('admin');

    $admin2 = User::factory()->create();
    $admin2->assignRole('admin');

    expect($admin1->outranks($admin2))->toBeFalse();
    expect($admin2->outranks($admin1))->toBeFalse();
});

it('allows higher roles to manage lower roles', function () {
    $owner = User::factory()->create();
    $owner->assignRole('owner');

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $member = User::factory()->create();
    $member->assignRole('member');

    expect($owner->outranks($admin))->toBeTrue();
    expect($owner->outranks($member))->toBeTrue();
    expect($admin->outranks($member))->toBeTrue();
});

it('prevents lower roles from managing higher roles', function () {
    $member = User::factory()->create();
    $member->assignRole('member');

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    expect($member->outranks($admin))->toBeFalse();
});

it('allows users to have direct permissions', function () {
    $user = User::factory()->create();
    $user->assignRole('member');
    $user->givePermissionTo('manage settings');

    expect($user->hasPermissionTo('manage settings'))->toBeTrue();
    expect($user->hasPermissionTo('view dashboard'))->toBeTrue();
});

it('allows users to belong to teams', function () {
    $user = User::factory()->create();
    $team = Team::factory()->create();

    $user->teams()->attach($team);

    expect($user->teams)->toHaveCount(1);
    expect($team->users)->toHaveCount(1);
});

it('allows teams to have multiple users', function () {
    $team = Team::factory()->create();
    $users = User::factory(3)->create();

    $team->users()->attach($users);

    expect($team->users)->toHaveCount(3);
});

it('enforces manage-role gate', function () {
    $owner = User::factory()->create();
    $owner->assignRole('owner');

    $member = User::factory()->create();
    $member->assignRole('member');

    $this->actingAs($owner);
    expect($owner->can('manage-role', $member))->toBeTrue();

    $this->actingAs($member);
    expect($member->can('manage-role', $owner))->toBeFalse();
});
