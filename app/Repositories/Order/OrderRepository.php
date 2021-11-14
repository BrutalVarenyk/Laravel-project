<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Order\Contracts\OrderRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class OrderRepository implements  OrderRepositoryInterface
{

    public function create(Request $request): Order
    {
        $total = Cart::instance('cart')->total(2, '.', '');
        $user = auth()->user();

        if ($user->balance < $total) {
            throw new \Exception('Not enough money on balance', 200);
        }

        $status = OrderStatus::where('name', '=', Config::get('constants.db.order_statuses.in_process'))->first();
        $orderData = $request->validated();

        $orderData['status_id'] = $status->id;
        $orderData['total'] = $total;

        $order = $user->orders()->create($orderData);

        $this->addProductsToOrder($order);

        $userBalance = [
            'balance' => $user->balance - $total
        ];

        $balance = $user->balance;
        $user->update($userBalance);

        dd($balance, $user->balance, $userBalance);

        return $order;

    }

    private function addProductsToOrder(Order $order)
    {
        $cartItems = Cart::instance('cart')->content()->groupBy('id');

        $cartItems->each(function ($item) use ($order) {
            $product = $item[0];
            $order->products()->attach(
                $product->model,
                [
                    'quantity' => $product->qty,
                    'single_price' => $product->model->getPrice()
                ]
            );
        });

    }
}
