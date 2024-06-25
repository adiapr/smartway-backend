<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\MediaLibrary\Conversions\Manipulations;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'slug', 'name', 'caption', 'body', 'category', 'publishment', 'approved_at', 'user_id'
    ];


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

    public function getCoverUrlAttribute()
    {
        $mediaItems = $this->getFirstMediaUrl('cover', 'thumb');

        if ($mediaItems) {
            return $mediaItems;
        } else {
            return asset('img/thumbnail/default.jpg');
        }
    }
}

