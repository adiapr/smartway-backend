<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
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

    public function getStatusOrderAttribute()
    {
        if ($this->status == OrderStatusEnum::PENDING) {
            return '<span class="badge badge-warning">Pending<span>';
        }

        if ($this->status == OrderStatusEnum::SUCCESS) {
            return '<span class="badge badge-success">Success<span>';
        }

        if ($this->status == OrderStatusEnum::EXPIRED) {
            return '<span class="badge badge-danger">Expired<span>';
        }

        if ($this->status == OrderStatusEnum::WAITING) {
            return '<span class="badge badge-secondary">Waiting<span>';
        }
    }

    public function product()
    {
        return $this->morphTo();
    }

    public function tour(){
        return $this->hasOne(Tour::class, 'id', 'product_id');
    }

    public function detail(){
        return $this->hasOne(OrderTour::class, 'order_id', 'id');
    }
}
