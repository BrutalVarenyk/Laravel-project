<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'short_description',
        'SKU',
        'price',
        'discount',
        'in_stock',
        'thumbnail'
    ];

    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function order_product()
    {
        return $this->hasOne(OrderProduct::class);
    }

    public function getPrice()
    {
        if (!is_null($this->discount)){
            $price = $this->price - ($this->price * ($this->discount / 100));
            return round($price, 2);
        }else{
            return $this->price;
        }
    }
}
