<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use App\Models\OrderTour;
use App\Models\Tour;
use App\Models\TourPrice;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function cart($uuid){
        $tour =  TourPrice::where('uuid', $uuid)->with('tour')->firstOrFail();

        return $tour;
    }

    public function cartCar($uuid)
    {
        $car = Car::where('uuid', $uuid)->with('media')->firstOrFail();
        return $car;
    }

    public function checkAvailability(Request $request)
    {
        $tanggalKeberangkatan = $request->input('keberangkatan');
        $tourId = $request->input('tour_id');

        // Cari semua order di mana product_type adalah 'App\Model\Tours' dan product_id sesuai dengan tour ID
        $orders = Order::where('product_type', Tour::class)
                    ->where('product_id', $tourId)
                    ->pluck('id'); // Dapatkan hanya order_id

        if ($orders->isEmpty()) {
            // Jika tidak ada order untuk tour ini, berarti tanggalnya tersedia
            return response()->json(['available' => true, 'message' => 'Masih tersedia slot pemesanan di tanggal ini.']);
        }

        // Cek di tabel order_tours apakah ada status 0 untuk order_ids yang ditemukan
        $isAvailable = !OrderTour::whereIn('order_id', $orders)
            ->where('keberangkatan', $tanggalKeberangkatan)
            ->where('status', 1)
            ->exists();

        if ($isAvailable) {
            return response()->json(['available' => true, 'message' => 'Masih tersedia slot pemesanan di tanggal ini.']);
        } else {
            return response()->json(['available' => false, 'message' => 'Mohon maaf pemesanan tour di tanggal ini sudah terisi.']);
        }
    }


}
