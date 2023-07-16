<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Product;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'product_id', 'qty', 'price', 'variant', 'subtotal'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}