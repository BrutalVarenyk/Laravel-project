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

    public function create()
    {
        return view('admin/products/new');
    }

    public function store(CreateProductRequest $request)
    {
        Product::create([
            'category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'SKU' => $request->SKU,
            'price' => $request->price,
            'discount' => $request->discount,
            'in_stock' => $request->in_stock,
            'thumbnail' => ''
        ]);
        return redirect('lang/admin/products');
    }

    public function edit(Product $product)
    {
        $category = $product->category()->first();

        return view('admin/products/edit', compact('product', 'category'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect('lang/admin/products/');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('lang/admin/products/')->with('success', __('Product deleted successfully'));
    }

}
