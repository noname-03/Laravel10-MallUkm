<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailTransaction;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'address_id',
            'order_id',
            'courier',
            'cost_courier',
            'receipt_number',
            'total',
            'payment_url',
            'status'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}