<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductAppearedNotification;
use App\Notifications\ProductDiscountNotification;
use App\Services\Images\ImageService;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        // Notification of product appearance for product followers
        if ($product->in_stock > 0 && $product->getOriginal('in_stock') == 0) {
            $product->followers()
                ->get()
                ->each
                ->notify(new ProductAppearedNotification($product));
        }

        if ($product->discount > 0
            && ($product->getOriginal('discount') == 0 || is_null($product->getOriginal('discount')))) {
            $product->followers()
                ->get()
                ->each
                ->notify(new ProductDiscountNotification($product));
        }

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        ImageService::remove($product->thumbnail);
        $product->orders()->detach();
        $images = $product->gallery()->get();
        if ($images->count() > 0) {
            foreach ($images as $image) ImageService::remove($image->path);
        }
    }

}
