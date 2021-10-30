<?php

namespace App\Services\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartQuantityService implements CartQuantityServiceInterface
{

    public static function refreshQuantity(string $rowId, Product $product, bool $option = true)
    {
        $row = Cart::instance('cart')->get($rowId);
        $product->update([
            'in_stock' => ($option === true) ? ($product->in_stock + $row->qty) : ($product->in_stock - $row->qty)
        ]);
    }
}
