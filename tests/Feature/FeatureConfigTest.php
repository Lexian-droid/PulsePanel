<?php

it('has registration feature flag', function () {
    expect(config('pulsepanel.features.registration'))->toBeBool();
});

it('has teams feature flag', function () {
    expect(config('pulsepanel.features.teams'))->toBeBool();
});

it('has role hierarchy config', function () {
    $hierarchy = config('pulsepanel.role_hierarchy');

    expect($hierarchy)->toBeArray();
    expect($hierarchy)->toHaveKeys(['owner', 'admin', 'moderator', 'member']);
    expect($hierarchy['owner'])->toBeGreaterThan($hierarchy['admin']);
    expect($hierarchy['admin'])->toBeGreaterThan($hierarchy['moderator']);
    expect($hierarchy['moderator'])->toBeGreaterThan($hierarchy['member']);
});

it('has default role config', function () {
    expect(config('pulsepanel.default_role'))->toBe('member');
});
