<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Images\ImageService;
use App\Services\Images\ProductImagesService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin/products/index', compact('products'));
    }

    public function create()
    {
        return view('admin/products/new');
    }

    public function store(CreateProductRequest $request)
    {
        $fields = $request->validated();

        $category = Category::find($fields['category']);

        $images = !empty($fields['images']) ? $request->file('images') : [];
        $product = $category->products()->create($fields);

        ProductImagesService::attach($product, $images);

        return redirect()->route('lang.admin.products');
    }

    public function edit(Product $product)
    {
        $category = $product->category()->first();

        return view('admin/products/edit', compact('product', 'category'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        if (!empty($validated['images']))
        ProductImagesService::attach($product, $validated['images']);
        return redirect()->back()->with('Product was successfully updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('lang.admin.products')->with('status', __('Product deleted successfully'));
    }

}
