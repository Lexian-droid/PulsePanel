<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        $owner = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pulsepanel.test',
            'password' => bcrypt('password'),
        ]);

        $owner->assignRole('owner');

        User::factory(14)->create()->each(function (User $user) {
            $user->assignRole(config('pulsepanel.default_role', 'member'));
        });
    }
}
