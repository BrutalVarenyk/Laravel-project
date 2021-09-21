<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    use HasFactory;

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isAdmin() :bool
    {
        //Role::where()
        $adminRole = $this->where(
            'name',
            '=',
            Config::get('constants.db.roles.admin')
        );
        //auth()->user()
        //auth - facade's type
        return Auth::user()->role_id === $adminRole->id;
    }
}
