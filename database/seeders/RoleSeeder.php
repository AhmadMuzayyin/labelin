<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $authorities = config('permission.authorities');
        $listPermission = [];
        $superAdminPermission = [];
        $adminToko = [];
        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                ];
                // hak akses super admin
                $superAdminPermission[] = $permission;

                // editor
                if (in_array($label, ['penjualan', 'isi_saldo', 'setting_web', 'laporan'])) {
                    $adminToko[] = $permission;
                }
            }
        }

        // Insert permission
        Permission::insert($listPermission);

        // Insert nama Roles Super Admin
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // Insert nama Roles Editor
        $editor = Role::create([
            'name' => 'Admin Toko',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // pemberian hak akses
        $superAdmin->givePermissionTo($superAdminPermission);
        $editor->givePermissionTo($adminToko);

        //assign Roles
        $userSuperAdmin = User::find(1)->assignRole("Super Admin");
    }
}
