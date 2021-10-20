<?php

namespace App\Services\Images;

use App\Models\Product;

interface ProductImagesServiceInterface
{
    public static function attach (Product $product, array $images = []);
}
