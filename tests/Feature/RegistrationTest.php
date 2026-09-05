<?php

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleAndPermissionSeeder::class);
    $this->withoutVite();
});

it('shows login page', function () {
    $this->get(route('login'))->assertSuccessful();
});

it('hides registration link when registration is disabled', function () {
    config(['pulsepanel.features.registration' => false]);

    $this->get(route('login'))
        ->assertSuccessful()
        ->assertDontSee('Sign up');
});

it('shows registration link when registration is enabled', function () {
    config(['pulsepanel.features.registration' => true]);

    $this->get(route('login'))
        ->assertSuccessful()
        ->assertSee('Sign up');
});

it('registers a user with the default role', function () {
    $this->post(route('register'), [
        'name' => 'New User',
        'email' => 'new.user@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'owner',
    ])->assertRedirect(route('dashboard'));

    $user = User::query()->where('email', 'new.user@example.com')->firstOrFail();

    expect($user->hasRole('member'))->toBeTrue();
    expect($user->hasRole('owner'))->toBeFalse();
    $this->assertAuthenticatedAs($user);
});
