<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'description', 'publishment'
    ];

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
}
