<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccessLevelService
{
    public function __construct()
    {
    }

    public function storeRole(string $name): void
    {
        try {
            DB::beginTransaction();

            Role::create(["name" => $name]);

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            Throw $e;
        }
    }

    public function storePermission(string $name, string $role_name): void
    {
        try {
            DB::beginTransaction();

            $role = Role::findByName($role_name);

            $permission = Permission::create(["name" => $name]);

            $permission->assignRole($role);

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            Throw $e;
        }
    }

    public function grantRole(string $role_name, int $user_id): void
    {
        try {
            DB::beginTransaction();

            $user = User::find($user_id);

            $user->syncRoles([]);

            $role = Role::findByName($role_name);

            $user->assignRole($role);

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            Throw $e;
        }
    }

}
