<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'description' => 'Administrator with full access'],
            ['name' => 'Judge', 'description' => 'Judicial officer with permission to review evidence'],
            ['name' => 'Lawyer', 'description' => 'Legal practitioner representing clients'],
            ['name' => 'Investigator', 'description' => 'Police or legal investigator who uploads evidence'],
            ['name' => 'Witness', 'description' => 'Person submitting evidence or testimony'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }

        $this->command->info('Default roles created successfully.');
    }
}
