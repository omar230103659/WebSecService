<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class EnsureManageCreditsPermissionExistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'manage_credits' permission if it doesn't exist
        $manageCreditsPermission = Permission::firstOrCreate([
            'name' => 'manage_credits',
            'guard_name' => 'web',
            'display_name' => 'Manage Credits', // Add a display name
        ]);

        // Assign 'manage_credits' permission to admin role
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($manageCreditsPermission);
            $this->command->info("Assigned 'manage_credits' permission to manager role.");        }

        // Assign 'manage_credits' permission to manager role
        $managerRole = Role::where('name', 'manager')->first();
        if ($managerRole) {
            $managerRole->givePermissionTo($manageCreditsPermission);
            $this->command->info("Assigned 'manage_credits' permission to manager role.");
        }

        // Clear permissions cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Permissions cache cleared.');
    }
} 