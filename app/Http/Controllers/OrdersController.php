<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Order\OrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(OrderRepository $orderRepository, CreateOrderRequest $request)
    {
        try{
            $order = $orderRepository->create($request);

            Cart::instance('cart')->destroy();
            return redirect()->route('lang.home')->with(['status' => 'Order "' . $order->id . '" was created']);

        } catch (\Exception $exception) {
            dd($exception->getCode() . ' - ' . $exception->getMessage());
        }
    }
}
