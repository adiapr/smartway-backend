<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tour_id',
        'jml_peserta',
        'status',
        'keberangkatan',
        'name',
        'pasport',
        'birthday',
        'phone',
        'instagram',
        'tiktok',
        'email',
    ];
    
}
