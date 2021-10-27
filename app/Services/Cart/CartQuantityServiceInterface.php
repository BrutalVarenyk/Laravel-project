<?php

namespace App\Services\Cart;

use App\Models\Product;

interface CartQuantityServiceInterface
{
    /**
     * @param string $rowId
     * @param Product $product
     * @param int $option
     * @return mixed
     *
     * Refresh quantity of product due to changing of qty in cart
     */
    public static function refreshQuantity(string $rowId, Product $product, bool $option = true);
}
