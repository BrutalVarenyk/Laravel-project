<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Config::get('constants.db.roles');

//        dd(Config::get('constants'));
//        Role::create(['name' => $roles['admin']]);
        Role::create(['name' => $roles['customer']]);

//        foreach ($roles as $key => $role) {
//            Role::create(['name' => "$role"]);
//        }
    }
}
