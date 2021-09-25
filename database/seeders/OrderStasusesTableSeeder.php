<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class OrderStasusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = Config::get('constants.db.order_statuses');

        foreach ($statuses as $key => $status) {
//            dd($status);
            OrderStatus::create(['name' => $status]);
        }
    }
}
