<?php

namespace App\Repositories\Order\Contracts;

use App\Models\Order;
use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function create(Request $request): Order;
}
