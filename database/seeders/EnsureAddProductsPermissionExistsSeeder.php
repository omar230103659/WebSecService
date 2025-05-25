<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EnsureAddProductsPermissionExistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'add_products' permission if it doesn't exist
        Permission::firstOrCreate([
            'name' => 'add_products',
            'guard_name' => 'web',
            'display_name' => 'Add Products', // Add a display name
        ]);

        $this->command->info('Ensured \'add_products\' permission exists.');

        // Clear permissions cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permissions cache cleared.');
    }
} 