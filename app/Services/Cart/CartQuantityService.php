<?php

namespace App\Services\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartQuantityService implements CartQuantityServiceInterface
{

    public static function returnQuantity(string $rowId, Product $product)
    {
        $row = Cart::instance('cart')->get($rowId);
        $product->update(['in_stock' => ($product->in_stock + $row->qty)]);
    }

    public static function takeQuantity(string $rowId, Product $product)
    {
        $row = Cart::instance('cart')->get($rowId);
        $product->update(['in_stock' => ($product->in_stock - $row->qty)]);
    }
}
