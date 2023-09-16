<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryProduct;
use App\Models\Cart;
use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'price',
        'price_retail',
        'qty',
        'weight',
        'promo',
        'unit',
        'unit_variant',
        'description',
        'photo',
    ];

    protected $dates = ['deleted_at'];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id', 'id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}