<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Feature Toggles
    |--------------------------------------------------------------------------
    |
    | Control which major features are enabled in your PulsePanel application.
    | Disabled features will be fully hidden — routes, navigation items, and
    | backend behavior will all respect these flags.
    |
    */

    'features' => [

        /*
        |----------------------------------------------------------------------
        | User Registration
        |----------------------------------------------------------------------
        |
        | When enabled, new users can register via the /register route.
        | When disabled, only existing users (or seeded users) can log in.
        |
        */

        'registration' => (bool) env('PULSEPANEL_REGISTRATION', false),

        /*
        |----------------------------------------------------------------------
        | Teams
        |----------------------------------------------------------------------
        |
        | When enabled, users can be organized into teams. Teams act as
        | organizational groups that can have projects and resources
        | assigned to them.
        |
        */

        'teams' => (bool) env('PULSEPANEL_TEAMS', false),

    ],

    /*
    |--------------------------------------------------------------------------
    | Role Hierarchy
    |--------------------------------------------------------------------------
    |
    | Define the hierarchy level for each role. Higher numbers indicate
    | greater authority. Users can only manage roles with a strictly
    | lower level than their own. Peers at the same level cannot
    | modify each other's roles.
    |
    | The 'owner' role has the highest level by default. When creating
    | custom roles, assign them a level here or they default to 0.
    |
    */

    'role_hierarchy' => [
        'owner' => 100,
        'admin' => 50,
        'moderator' => 25,
        'member' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Role
    |--------------------------------------------------------------------------
    |
    | The role automatically assigned to newly registered users.
    |
    */

    'default_role' => 'member',

];
