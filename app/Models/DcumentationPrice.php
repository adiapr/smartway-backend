<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DcumentationPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'documentation_service_id',
        'name',
        'start_price',
        'price',
        'duration',
        'edited',
        'downloadable',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
