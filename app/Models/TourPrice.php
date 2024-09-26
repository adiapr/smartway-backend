<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TourPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'name',
        'start_price',
        'price',
        'urutan',
        'pax',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
