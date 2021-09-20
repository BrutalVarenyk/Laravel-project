<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        //with - подтягиваем информацию сразу и категорий продуктов
        $products = Product::query()->with('category')->paginate(12);
        return view('products/index', compact('products'));
    }

    public function show(Product $product)
    {

    }
}
