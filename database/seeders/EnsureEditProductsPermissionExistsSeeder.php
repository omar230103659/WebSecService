<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EnsureEditProductsPermissionExistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'edit_products' permission if it doesn't exist
        Permission::firstOrCreate([
            'name' => 'edit_products',
            'guard_name' => 'web',
            'display_name' => 'Edit Products', // Add a display name
        ]);

        $this->command->info('Ensured \'edit_products\' permission exists.');

        // Clear permissions cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permissions cache cleared.');
    }
} 