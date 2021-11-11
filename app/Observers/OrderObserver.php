<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $user = $order->user()->first();
        $user->notify(new OrderCreatedNotification($user, $order->id));

        $admin = User::where('role_id', '=', 1)->first();
        $admin->notify(new OrderCreatedNotification($admin, $order->id, false));
    }
}
