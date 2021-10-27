<?php

namespace App\Services\Cart;

use App\Models\Product;

interface CartQuantityServiceInterface
{
    /**
     * @param string $rowId
     * @param Product $product
     * @return mixed
     *
     * Return quantity from cart to product
     */
    public static function returnQuantity(string $rowId, Product $product);
}
