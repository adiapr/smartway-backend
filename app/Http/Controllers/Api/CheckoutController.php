<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourPrice;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function cart($uuid){
        $tour =  TourPrice::where('uuid', $uuid)->with('tour')->firstOrFail();

        return $tour;
    }
}
