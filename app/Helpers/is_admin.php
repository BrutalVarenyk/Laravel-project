<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Config;

if (!function_exists('is_admin')){
    function is_admin(User $user)
    {
        $adminRole = Role::where(
            'name',
            '=',
            Config::get('constants.db.roles.admin')
        )->first();

        return auth()->user()->role_id === $adminRole->id;
    }
}
