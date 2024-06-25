<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        $car = Car::with('media')->latest()->paginate(20);

        return $car;
    }

    public function show($slug){
        $car = Car::where('slug', $slug)->with('media')->firstOrFail();
        return $car;
    }
}
