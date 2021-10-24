<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Services\Images\ImageService;

class ProductImageObserver
{
    public function deleted(ProductImage $productImage)
    {
        ImageService::remove($productImage->path);
    }
}
