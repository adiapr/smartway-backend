<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
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
        'product_id'
    ];
}
