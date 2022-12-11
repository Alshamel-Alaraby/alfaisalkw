<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123456'
        ]);

        $role = Role::create(['name'=>'Admin', 'guard_name' => 'admin']);

        Permission::insert([
            ['name' => 'Create Roles','guard_name' => 'admin'],
            ['name' => 'Edit Roles','guard_name' => 'admin'],
            ['name' => 'Delete Roles','guard_name' => 'admin'],
            ['name' => 'List Roles','guard_name' => 'admin'],

            ['name' => 'Create Users','guard_name' => 'admin'],
            ['name' => 'Edit Users','guard_name' => 'admin'],
            ['name' => 'Delete Users','guard_name' => 'admin'],
            ['name' => 'List Users','guard_name' => 'admin'],

        ]);

        $role->syncPermissions(['Create Roles','Edit Roles','Delete Roles','List Roles',
            'Create Users', 'Edit Users', 'Delete Users', 'List Users'
        ]);

        $admin->syncRoles('Admin');
    }
}
