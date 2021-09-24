<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
//        dd($products);
        return view('admin/products/index', compact('products'));
    }

    public function edit(Product $product)
    {
        $category = $product->category()->get();

        return view('admin/products/{product}/edit', compact('product', 'category'));
    }

    public function update(Product $product)
    {
        $product->update();
        return redirect('admin/products/index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('admin/products/index');
    }

}
