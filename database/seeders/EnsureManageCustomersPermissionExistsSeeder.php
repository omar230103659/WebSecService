<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EnsureManageCustomersPermissionExistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'manage_customers' permission if it doesn't exist
        Permission::firstOrCreate([
            'name' => 'manage_customers',
            'guard_name' => 'web',
            'display_name' => 'Manage Customers', // Add a display name
        ]);

        $this->command->info('Ensured \'manage_customers\' permission exists.');

        // Clear permissions cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permissions cache cleared.');
    }
} 