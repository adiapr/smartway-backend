<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDocumentationService extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'documentation_services_id',
        'dcumentation_prices_id',
        'selected_option',
        'price',
        'date',
        'time',
        'pax',
        'location',
        'location_detail',
        'payment_method',
        'user_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
