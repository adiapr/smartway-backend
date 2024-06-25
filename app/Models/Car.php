<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Car extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'location_id',
        'category',
        'transmission',
        'start_price',
        'price',
        'ratings',
        'reviews_count',
        'passenger_count',
        'luggage_count',
        'mileage',
        'include_driver'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(900)
            ->height(700);
    }

    // get image
    public function getCoverUrlAttribute()
    {
        $mediaItems = $this->getFirstMediaUrl('cover', 'thumb');

        if ($mediaItems) {
            return $mediaItems;
        } else {
            return asset('img/thumbnail/default.jpg');
        }
    }

    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }

    public function documentations(){
        return $this->morphMany(Documentation::class, 'documentations');
    }
}
