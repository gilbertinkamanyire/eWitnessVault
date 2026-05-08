<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the RolesSeeder first to create roles
        $this->call([
            RolesSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
