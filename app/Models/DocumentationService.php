<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DocumentationService extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_price',
        'price',
        'q1',
        'q2',
        'q3',
        'q4',
        'include2',
        'include1',
        'section2',
        'description2'
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

    public function documentations(){
        return $this->morphMany(Documentation::class, 'documentations');
    }
}
