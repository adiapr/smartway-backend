<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
// use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            // Log request data
            Log::info('Request Data:', $request->all());

            // Validasi data request
            $validatedData = $request->validate([
                'kode' => 'required',
                'metode' => 'required',
                'total' => 'required|numeric',
                'product_type' => 'required',
                'product_id' => 'required|integer'
            ]);

            // Buat order baru di database
            $validatedData['status'] = 'PENDING';
            $order = Order::create($validatedData);

            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Buat parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $order->total,
                ],
                'customer_details' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                    'phone' => '081234567890',
                ],
            ];

            // Dapatkan Snap token
            $snapToken = Snap::getSnapToken($params);

            // Kembalikan response dengan Snap token
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            // Log error
            Log::error('Error creating order: ' . $e->getMessage());

            // Kembalikan response error
            return response()->json(['error' => 'Error creating order'], 500);
        }
    }
}
