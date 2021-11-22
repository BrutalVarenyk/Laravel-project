<?php

namespace App\Models;

use App\Services\Images\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'product_id'

    ];

    protected $fillable = ['path', 'product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    // Mutator
    public function setPathAttribute($image)
    {
        if (!is_string($image)) {
            $this->attributes['path'] = ImageService::upload($image);
        } else {
            $this->attributes['path'] = getenv('APP_URL') . $image;
        }

    }
}
