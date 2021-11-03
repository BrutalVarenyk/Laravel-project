<?php

namespace App\Services\Wishlist;

use App\Models\Product;

interface WishListServiceInterface
{
    public function isUserFollowed(Product $product): bool;
}
