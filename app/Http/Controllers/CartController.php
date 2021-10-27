<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart\CartQuantityService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart/index');
    }

    public function add(Request $request, Product $product)
    {
        Cart::instance('cart')->add(
            $product->id,
            $product->title,
            $request->product_count,
            $product->getPrice(),
        );

        $product->update([
            'in_stock' => ($product->in_stock - $request->product_count)
        ]);

        return redirect()->back()->with(['status' => 'Product was successfully added to cart']);
    }

    public function delete(Request $request, Product $product)
    {
        CartQuantityService::refreshQuantity($request->rowId, $product);

        Cart::instance('cart')->remove($request->rowId);
        return redirect()->back()->with(['status' => 'Product was successfully removed from cart']);
    }

    public function countUpdate(Request $request, Product $product)
    {
        if ($product->in_stock < $request->product_count) {
            return redirect()
                ->back()
                ->with(["status" => "The product {$product->title} has only {$product->in_stock} items"]);
        }

        CartQuantityService::refreshQuantity($request->rowId, $product);

        Cart::instance('cart')->update(
          $request->rowId,
          $request->product_count
        );

        CartQuantityService::refreshQuantity($request->rowId, $product, false);

        return redirect()->back();
    }
}
