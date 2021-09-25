<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
        $category = $product->category()->first();

        return view('admin/products/edit', compact('product', 'category'));
    }

    public function update(UpdateProductRequest $request,Product $product)
    {
        $product->update($request->validated());
        return redirect('admin/products/');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('admin/products/')->with('success','Product deleted successfully');;
    }

}
