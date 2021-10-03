<?php

namespace App\Models;

use App\Services\Images\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    // Mutator
    public function setPathAttribute($image)
    {
        $this->attributes['path'] = ImageService::upload($image);
    }
}
