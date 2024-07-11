<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'user_id',
        'metode',
        'metadata',
        'voucher_id',
        'diskon',
        'total',
        'harga_jual',
        'status',
        'success_at',
        'payment_type',
        'product_type',
        'product_id',
        'snap_token',
        'card_type',
        'bank',
        'va_numbers'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
