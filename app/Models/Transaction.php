<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'address_id',
            'courier',
            'receipt_number',
            'total',
            'payment_token',
            'payment_url',
            'status'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
