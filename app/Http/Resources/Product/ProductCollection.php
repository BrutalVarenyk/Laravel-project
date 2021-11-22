<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
//use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ProductCollection extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'product';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $gallery = $this->gallery()->get();
        $category = $this->category()->first();

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'SKU' => $this->SKU,
            'prices' => [
                'price' => $this->price,
                'discount' => $this->discount,
                'calculated_price' => $this->getPrice()
            ],
            'in_stock' => $this->in_stock,
            'thumbnail' => getenv('APP_URL') . Storage::url($this->thumbnail),
            'gallery' => !empty($gallery[0]) ? GalleryCollection::collection($gallery) : '',
            'category' => CategoryResource::make($category)
        ];
    }
}
