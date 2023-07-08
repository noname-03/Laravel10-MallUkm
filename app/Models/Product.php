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
        'price',
        'price_retail',
        'qty',
        'unit',
        'unit_variant',
        'description',
        'photo',
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}