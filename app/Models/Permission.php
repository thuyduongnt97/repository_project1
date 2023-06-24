<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['name', 'slug', 'user_id', 'created_at', 'updated_at'];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permisson_rolses', 'permission_id', 'role_id');
    }


}
