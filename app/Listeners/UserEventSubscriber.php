<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEventSubscriber
{
    public function handleUserLogin($event)
    {
        Cart::instance('cart')
            ->restore($event->user->instanceCartName());
    }

    public function handleUserLogout($event)
    {
        if (Cart::instance('cart')->count() > 0) {
            Cart::instance('cart')
                ->store($event->user->instanceCartName());
        }

    }

    public function  subscribe($events)
    {
        // Register listener methods to events
        $events->listen(
          'Illuminate\Auth\Events\Login',
          'App\Listeners\UserEventSubscriber@handleUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );
    }

}
