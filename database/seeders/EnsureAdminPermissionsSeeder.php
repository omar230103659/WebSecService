<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EnsureAdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the admin role
        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            // Assign ALL permissions to the admin role
            $allPermissions = Permission::all();
            $adminRole->syncPermissions($allPermissions);

            $this->command->info('Ensured admin role has ALL permissions.');
             // Clear permissions cache
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            $this->command->info('Permissions cache cleared.');

        } else {
            $this->command->warn('Admin role not found. Cannot assign permissions.');
        }
    }
} 