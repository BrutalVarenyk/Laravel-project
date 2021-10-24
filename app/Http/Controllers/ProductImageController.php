<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Services\Images\ImageService;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function destroy($imageId)
    {
        $image = ProductImage::find($imageId);
        $image->delete();

        return response()->json(['success' => 'Image was successfully deleted']);
    }
}
