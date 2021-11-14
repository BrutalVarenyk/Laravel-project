<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Order\OrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function store(OrderRepository $orderRepository, CreateOrderRequest $request)
    {
        try{
            DB::beginTransaction();
            $order = $orderRepository->create($request);

            Cart::instance('cart')->destroy();
            DB::commit();
            return redirect()->route('lang.home')->with(['status' => 'Order "' . $order->id . '" was created']);
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getCode() . ' - ' . $exception->getMessage());
        }
    }
}
