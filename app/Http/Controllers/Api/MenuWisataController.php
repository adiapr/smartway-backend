<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Tour;
use Illuminate\Http\Request;

class MenuWisataController extends Controller
{
    public function domestik()
    {
        // $location = Location::with('menuList:name,slug as routePath,location_id')->select(['id', 'location as title'])->whereType('Domestik')->get();
        $location = Location::with(['menuList' => function($query) {
            $query->select('id', 'name', 'slug as routePath', 'location_id')->with('media')->where('publishment', 'published');
        }])->select(['id', 'location as title'])
        ->whereType('Domestik')
        ->get();

        return $location;
    }

    public function internasional()
    {
        $location = Location::with('menuList:name,slug as routePath,location_id')->select(['id', 'location as title'])->whereType('Internasional')->get();

        return $location;
    }

    public function all(){
        $tours = Tour::with(['location','media'])->where('publishment', 'published')->latest()->get();

        return response()->json($tours);
    }

    public function show($slug){
        $tour = Tour::with(['location', 'media', 'documentations.media', 'tour_schedules', 'prices'])->whereSlug($slug)->firstOrFail();

        return response()->json($tour);
    }
}
