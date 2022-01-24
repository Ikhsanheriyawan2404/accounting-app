<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Superadmin',
            'guard_name' => 'web'
        ]);

        $role->givePermissionTo([
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
        ]);
    }
}
