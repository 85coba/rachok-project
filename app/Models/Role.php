<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
