<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;

class Tour extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'type',
        'destination',
        'location_id',
        'description',
        'packet',
        'no_packet',
        'publishment',
        'duration',
        'group_size',
        'transportation',
        'free_cancel',
        'map',
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

    public function schedules(){
        return $this->hasMany(TourSchedule::class);
    }

    public function documentations(){
        return $this->morphMany(Documentation::class, 'documentations');
    }

    public function tour_schedules(){
        return $this->hasMany(TourSchedule::class)->orderBy('order_by', 'asc');
    }

    public function prices(){
        return $this->hasMany(TourPrice::class)->orderBy('name', 'asc');
    }
}
