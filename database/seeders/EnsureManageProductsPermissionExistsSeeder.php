<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EnsureManageProductsPermissionExistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'manage_products' permission if it doesn't exist
        Permission::firstOrCreate([
            'name' => 'manage_products',
            'guard_name' => 'web',
            'display_name' => 'Manage Products', // Add a display name
        ]);

        $this->command->info('Ensured \'manage_products\' permission exists.');

        // Clear permissions cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permissions cache cleared.');
    }
} 