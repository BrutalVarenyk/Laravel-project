<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
//use App\Http\Resources\ProductCollection;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::available()->with('category', 'gallery')->get();
        return ProductCollection::collection($products);
    }

    public function show(Product $product)
    {
        return ProductCollection::make($product);
    }
}



