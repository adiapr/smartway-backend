<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\TestimonyVideo;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        return Slider::wherePublishment('published')->with('media')->latest()->get();
    }

    public function testimony(){
        return TestimonyVideo::wherePublishment('published')->latest()->get();
    }
}
