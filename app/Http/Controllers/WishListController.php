<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class WishListController extends Controller
{
    public function add(Product $product)
    {
        auth()->user()->addToWish($product);

        $wishlistItem = Cart::instance('wishlist')->add(
            $product->id,
            $product->title,
            1,
            $product->getPrice()
        );

        $wishlistItem->associate(\App\Models\Product::class);

        return redirect()->back()->with("status", "Product {$product->title} was successfully added to wishlist");
    }

    public function delete(Request $request, Product $product)
    {
        auth()->user()->removeFromWish($product);

        if (!empty($request->rowId)) {
            Cart::instance('wishlist')->remove($request->rowId);
        }   else {
            $content = Cart::instance('wishlist')->content();

            foreach ($content as $item) {
                if ($item->id == $product->id) {
                    Cart::instance('wishlist')->remove($item->rowId);
                }
            }
        }
        return redirect()->back()->with("status", "Product {$product->title} was successfully removed from wishlist");

    }
}
