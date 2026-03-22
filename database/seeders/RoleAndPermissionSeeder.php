<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Seed the roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage teams',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Reset cache after creating permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles and assign permissions
        $member = Role::findOrCreate('member');
        $member->givePermissionTo('view dashboard');

        $moderator = Role::findOrCreate('moderator');
        $moderator->givePermissionTo(['view dashboard', 'manage teams']);

        $admin = Role::findOrCreate('admin');
        $admin->givePermissionTo(['view dashboard', 'manage users', 'manage teams', 'manage settings']);

        $owner = Role::findOrCreate('owner');
        $owner->givePermissionTo(Permission::all());
    }
}
