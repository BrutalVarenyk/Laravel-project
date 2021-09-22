<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'status'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin/orders/index', compact('orders'));
    }

    public function edit(Order $order)
    {
        $products = $order->products()->get();
        return view('admin/orders/{order}/edit', compact('order', 'products'));
    }
}
