<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductAppearedNotification;
use App\Services\Images\ImageService;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Support\Facades\Request;

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
