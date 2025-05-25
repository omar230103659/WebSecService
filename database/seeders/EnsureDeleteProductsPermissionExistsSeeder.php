<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EnsureDeleteProductsPermissionExistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'delete_products' permission if it doesn't exist
        Permission::firstOrCreate([
            'name' => 'delete_products',
            'guard_name' => 'web',
            'display_name' => 'Delete Products', // Add a display name
        ]);

        $this->command->info('Ensured \'delete_products\' permission exists.');

        // Clear permissions cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permissions cache cleared.');
    }
} 