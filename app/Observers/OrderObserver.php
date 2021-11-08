<?php

namespace App\Observers;

use App\Jobs\OrderCreatedNotificationJob;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use function Psy\debug;

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
        logs()->info('Notification Start');
        $user->notify(new OrderCreatedNotification($user, $order->id));
    }
}
