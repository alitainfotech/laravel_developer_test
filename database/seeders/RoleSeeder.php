<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permission to manage products
        $permission = Permission::create(['name' => 'manage-products']);

        // Admin role
        $admin = Role::create(['name' => 'admin']);

        // Assign permission to role
        $admin->givePermissionTo($permission);

        // B2B Customer role
        $b2b = Role::create(['name' => 'b2b-customer']);

        // B2C Customer role
        $b2c = Role::create(['name' => 'b2c-customer']);
    }
}
