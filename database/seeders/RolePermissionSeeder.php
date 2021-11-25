<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Role::create(['name' => 'User']);
        Role::create(['guard_name' => 'web', 'name' => 'Subscriber']);
        Role::create(['guard_name' => 'web', 'name' => 'Admin']);
        Role::create(['guard_name' => 'web', 'name' => 'Editor']);
        $roleSuperAdmin = Role::create(['guard_name' => 'web', 'name' => 'Super Admin']);

        /**
         * Admin User Permissions
         */
        $permissions = [

            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission.view',
                    'permission.create',
                    'permission.edit',
                    'permission.delete',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.view',
                    'admin.create',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'admin_profile',
                'permissions' => [
                    'admin_profile.view',
                    'admin_profile.edit',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.view',
                    'role.create',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'user.view',
                    'user.create',
                    'user.edit',
                    'user.delete',
                ]
            ],
            [
                'group_name' => 'publication',
                'permissions' => [
                    'publication.view',
                    'publication.create',
                    'publication.edit',
                    'publication.delete',
                ]
            ],
            [
                'group_name' => 'setting',
                'permissions' => [
                    'setting.view',
                    'setting.create',
                    'setting.edit',
                    'setting.delete',
                ]
            ],
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],


        ];

        for ($i = 0; $i < count($permissions); $i++) {

            $permissionGroup = $permissions[$i]['group_name'];
            for($j = 0; $j < count($permissions[$i]['permissions']); $j++){
                //create permission
                $permission = Permission::create(['guard_name' => 'web', 'name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
