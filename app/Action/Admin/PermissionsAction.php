<?php

namespace App\Action\Admin;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

final class PermissionsAction
{

    public function __construct()
    {

    }

    public function execute()
    {
        $admin = Auth::user();
        $rolesAndPermissions = [];
        $roles = Role::all();

        foreach ($roles as $role) {
            $rolesAndPermissions[$role->name] = $role->permission()
                ->pluck('permissions.name')->implode(', ');
        }
        
        return array('admin' => $admin, 'roles' => $rolesAndPermissions);
    }
}