<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'username', 'phone', 'address', 'destination_id', 'address_detail', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}