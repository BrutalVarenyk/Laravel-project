<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;

class RatingController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $product->rateOnce($request->starId);
        return response()->json(['success']);
    }
}
