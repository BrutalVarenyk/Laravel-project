<?php

namespace App\Services\Wishlist;

use App\Models\Product;

class WishlistService implements WishListServiceInterface
{

    public function isUserFollowed(Product $product): bool
    {
        $followers = $product->followers()->get()->pluck('id');

        return $followers->contains(auth()->id());
    }
}
