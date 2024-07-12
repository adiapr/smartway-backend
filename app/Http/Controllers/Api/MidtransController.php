<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
// use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class MidtransController extends Controller
{
    public function create(Request $request)
    {
        // Membuat pesanan baru berdasarkan data input
        $order = new Order();
        $order->kode = strtoupper(Str::random(8));
        if (Order::where('kode', $order->kode)->exists()) {
            $order->kode = strtoupper(Str::random(8)); // Coba lagi jika kode sudah ada
        }
        $order->status = 'waiting'; // Status awal pesanan
        $order->diskon = $request->input('harga_jual') - $request->input('total');
        
        // input data 
        // $order->snap_token = $request->input('snap_token');
        $order->user_id = $request->input('user_id');
        $order->metode = $request->input('metode');
        $order->harga_jual = $request->input('harga_jual');
        $order->total = $request->input('total');
        $order->product_type = $request->input('product_type');
        $order->product_id = $request->input('product_id');
        
        // Simpan pesanan ke dalam database
        try {
            $order->save();

            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');// Ganti ke true jika ingin menggunakan production environment
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            // Konfigurasi detail transaksi untuk Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $order->kode, // Menggunakan ID pesanan sebagai order_id di Midtrans
                    'gross_amount' => $order->total,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->user->phone,
                ],
            ];

            // Mendapatkan Snap Token dari Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Simpan snap token ke dalam pesanan
            $order->snap_token = $snapToken;
            $order->save();

            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create transaction', 'message' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Validasi signature key
        if ($hashed == $request->signature_key) {
            // Ambil order berdasarkan kode
            $order = Order::where('kode', $request->order_id)->first();

            // Pastikan order ditemukan
            if ($order) {
                // Tentukan status berdasarkan transaction_status dari Midtrans
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $status = 'success';
                } else if ($request->transaction_status == 'expire' || $request->transaction_status == 'failure') {
                    $status = 'expire';
                } else if ($request->transaction_status == 'cancel') {
                    $status = 'cancel';
                } else if ($request->transaction_status == 'pending') {
                    $status = 'pending';
                } else {
                    // Default jika tidak ada yang cocok
                    $status = 'unknown';
                }

                // Update status order
                $order->update([
                    'status' => $status,
                    'success_at' => date('Y-m-d H:i:s'),
                    'card_type' => $request->card_type ?? null,
                    'bank' => $request->bank ?? null,
                    'payment_type' => $request->payment_type,
                    'va_numbers' => $request->va_numbers ? json_encode($request->va_numbers) : null,
                ]);

                // Kirim respons 200 OK ke Midtrans
                return response()->json(['status' => 'OK']);
            } else {
                // Jika order tidak ditemukan, kirim respons 404 Not Found
                return response()->json(['error' => 'Order not found'], 404);
            }
        } else {
            // Jika signature key tidak valid, kirim respons 403 Forbidden
            return response()->json(['error' => 'Invalid signature key'], 403);
        }
    }


}
