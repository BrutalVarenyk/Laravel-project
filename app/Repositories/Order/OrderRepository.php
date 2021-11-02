<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Order\Contracts\OrderRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrderRepository implements  OrderRepositoryInterface
{

    public function create(Request $request): Order
    {
//        dd($request, $request->validated());
        $status = OrderStatus::where('name', '=', Config::get('constants.db.order_statuses.in_process'))->first();
//        dd($status);
        $orderData = $request->validated();

        $orderData['status_id'] = $status->id;
        $orderData['total'] = Cart::instance('cart')->total(2, '.', '');

        $cartItems = Cart::instance('cart')->content()->groupBy('id');
        $order = auth()->user()->orders()->create($orderData);

        $cartItems->each(function ($item) use ($order) {
            $product = $item[0];
            $order->products()->attach(
                $product->model,
                [
                    'quantity' => $product->qty,
                    'single_price' => $product->model->getPrice()
                ]
            );
            $product->model->update();
        });

        return $order;
    }
}
