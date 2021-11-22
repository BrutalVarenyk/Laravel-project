<?php

namespace App\Services\Images;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImagesService implements ProductImagesServiceInterface
{

    public static function attach(Product $product, array $images = [])
    {

        if (!empty($images)) {
            foreach ($images as $image) {
                $path = ImageService::upload($image);
                $product->gallery()->create(['path' => $path]);
            }
        }
    }
}
