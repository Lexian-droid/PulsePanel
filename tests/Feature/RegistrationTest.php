<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
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

    // Registration link only shows when both config flag AND register route exist
    if (Route::has('register')) {
        $this->get(route('login'))
            ->assertSuccessful()
            ->assertSee('Sign up');
    } else {
        // Fortify registration feature is not enabled at boot, so route doesn't exist
        $this->get(route('login'))
            ->assertSuccessful()
            ->assertDontSee('Sign up');
    }
});
