<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roleNames = [
            \App\Models\Role::ROLE_ADMIN,
            \App\Models\Role::ROLE_USER,
            \App\Models\Role::ROLE_SPECIAL,
        ];

        $permissionNames = [
            'campaigns.create',
            'campaigns.read',
            'campaigns.update',
            'campaigns.delete',

            'records.create',
            'records.read',
            'records.update',
            'records.delete',

            'templates.create',
            'templates.read',
            'templates.update',
            'templates.delete',

            'groups.create',
            'groups.read',
            'groups.update',
            'groups.delete',

            'contacts.create',
            'contacts.read',
            'contacts.update',
            'contacts.delete',
            'contacts.import',

            'messages.read',

            'calls.read',

            'emailQueues.create',
            'emailQueues.read',
            'emailQueues.update',
            'emailQueues.delete',

            'users.create',
            'users.read',
            'users.update',
            'users.delete',
            'users.assignRole',

            'settings.create',
            'settings.read',
            'settings.update',
            'settings.delete',
            'settings.emailer',

            'roles.create',
            'roles.read',
            'roles.update',
            'roles.delete',

            'packages.create',
            'packages.read',
            'packages.update',
            'packages.delete',

            'permissions.create',
            'permissions.read',
            'permissions.update',
            'permissions.delete',

            'activities.read'
        ];

        $permissionUser = [
            'campaigns.create',
            'campaigns.read',
            'campaigns.update',
            'campaigns.delete',

            'records.create',
            'records.read',
            'records.update',
            'records.delete',

            'templates.create',
            'templates.read',
            'templates.update',
            'templates.delete',

            'groups.create',
            'groups.read',
            'groups.update',
            'groups.delete',

            'contacts.create',
            'contacts.read',
            'contacts.update',
            'contacts.delete',
            'contacts.import',

            'messages.read',

            'calls.read',

            'packages.read',
        ];

        $permissionMapping = [
            \App\Models\Role::ROLE_ADMIN => $permissionNames,
            \App\Models\Role::ROLE_USER => $permissionUser,
            \App\Models\Role::ROLE_SPECIAL => [

            ]
        ];

        $roles = [];

        foreach ($roleNames as $roleName) {
            $roles[$roleName] = Role::findOrCreate($roleName);
        }

        foreach ($permissionNames as $permissionName) {
            Permission::findOrCreate($permissionName);
        }

        foreach ($permissionMapping as $roleName => $permissionNames) {
            if (!isset($roles[$roleName])) {
                break;
            }
            /** @var Role $role */
            $role = $roles[$roleName];
            $role->syncPermissions($permissionNames);
        }
    }
}
