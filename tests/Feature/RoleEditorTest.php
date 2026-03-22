<?php

use App\Livewire\Pages\RoleEditor;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleAndPermissionSeeder::class);
    $this->withoutVite();
});

it('denies access to users without manage users permission', function () {
    $member = User::factory()->create();
    $member->assignRole('member');

    $this->actingAs($member)
        ->get(route('dashboard.roles'))
        ->assertForbidden();
});

it('allows access to users with manage users permission', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get(route('dashboard.roles'))
        ->assertSuccessful();
});

it('displays users with their roles', function () {
    $admin = User::factory()->create(['name' => 'Admin User']);
    $admin->assignRole('admin');

    $member = User::factory()->create(['name' => 'Regular Member']);
    $member->assignRole('member');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->assertSee('Admin User')
        ->assertSee('Regular Member');
});

it('can search users by name', function () {
    $admin = User::factory()->create(['name' => 'Admin User']);
    $admin->assignRole('admin');

    User::factory()->create(['name' => 'Alice Smith'])->assignRole('member');
    User::factory()->create(['name' => 'Bob Jones'])->assignRole('member');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->set('search', 'Alice')
        ->assertSee('Alice Smith')
        ->assertDontSee('Bob Jones');
});

it('can filter users by role', function () {
    $owner = User::factory()->create(['name' => 'The Owner']);
    $owner->assignRole('owner');

    $admin = User::factory()->create(['name' => 'Admin Person']);
    $admin->assignRole('admin');

    $member = User::factory()->create(['name' => 'Member Person']);
    $member->assignRole('member');

    Livewire::actingAs($owner)
        ->test(RoleEditor::class)
        ->set('filterRole', 'member')
        ->assertSee('Member Person')
        ->assertDontSee('Admin Person');
});

it('can open edit modal for a lower-ranked user', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $member = User::factory()->create();
    $member->assignRole('member');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->call('editUser', $member->id)
        ->assertSet('editingUserId', $member->id)
        ->assertSet('selectedRole', 'member');
});

it('prevents editing a user of equal or higher rank', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $owner = User::factory()->create();
    $owner->assignRole('owner');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->call('editUser', $owner->id)
        ->assertSet('editingUserId', null);
});

it('can update a user role', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $member = User::factory()->create();
    $member->assignRole('member');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->call('editUser', $member->id)
        ->set('selectedRole', 'moderator')
        ->call('updateRole');

    expect($member->fresh()->hasRole('moderator'))->toBeTrue();
    expect($member->fresh()->hasRole('member'))->toBeFalse();
});

it('prevents assigning a role equal to or higher than the current user', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $member = User::factory()->create();
    $member->assignRole('member');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->call('editUser', $member->id)
        ->set('selectedRole', 'owner')
        ->call('updateRole');

    // Should still be member, not owner
    expect($member->fresh()->hasRole('member'))->toBeTrue();
});

it('only shows assignable roles below the current user level', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    Livewire::actingAs($admin)
        ->test(RoleEditor::class)
        ->assertViewHas('assignableRoles', function ($roles) {
            return $roles->contains('member')
                && $roles->contains('moderator')
                && ! $roles->contains('admin')
                && ! $roles->contains('owner');
        });
});
