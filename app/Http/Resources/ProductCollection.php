<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ProductCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'vehicle';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
    //     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $gallery = $this->gallery()->get()->each(function ($image){
            $image->path = Storage::url($image->path);
        });

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'SKU' => $this->SKU,
            'price' => $this->price,
            'discount' => $this->discount,
            'calculated_price' => $this->getPrice() ,
            'in_stock' => $this->in_stock,
            'thumbnail' => $this->thumbnail,
            'gallery' => $gallery,
            'category' => $this->category()->get()
        ];
    }
}
