<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default Admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['description' => 'Administrator with full access']
        );

        // Create default admin user with hardcoded credentials
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@ewitness.vault'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('eWitnessSecure@2026'),
                'phone' => '0700000000',
                'is_verified' => true,
            ]
        );

        // Attach admin role to the user
        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);

        $this->command->info('Hard-coded admin user updated: admin@ewitness.vault / eWitnessSecure@2026');
    }
}
