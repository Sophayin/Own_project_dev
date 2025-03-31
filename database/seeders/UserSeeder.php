<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Super Admin";
        $user->username = "superadmin";
        $user->email = "Superadmin@gmail.com";
        $user->phone = "085608106";
        $user->type = "Super Admin";
        $user->password = bcrypt(999999);
        $user->banned = false;
        $user->active = true;
        $user->save();

        $role = new Role();
        $role->name = 'Super Admin';
        $role->save();

        RoleUser::insert(['role_id' => $role->id, 'user_id' => $user->id, 'model' => "App/Models"]);
        $permission_array = Permission::distinct()->orderBy('department_id', 'asc')->pluck('department_id');
        foreach ($permission_array as $key => $item) {
            $permission = Permission::where('department_id', $item)->pluck('id')->toArray();
            $role_permission = new RolePermission();
            $role_permission->role_id = $role->id;
            $role_permission->department_id = $item;
            $role_permission->permission =  json_encode($permission, JSON_UNESCAPED_UNICODE);
            $role_permission->save();
        }
    }
}