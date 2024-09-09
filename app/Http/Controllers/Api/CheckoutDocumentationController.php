<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentationService;
use App\Models\Order;
use App\Models\OrderDocumentationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutDocumentationController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data dari tabel OrderDocumentationService
        $orderDocumentations = OrderDocumentationService::with('order.user') // Menggunakan eager loading untuk mengambil data terkait
        ->latest()    
        ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $orderDocumentations,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi data dari frontend
        $validator = Validator::make($request->all(), [
            'documentation_services_id' => 'required',
            'documentation_prices_id' => 'required', // Menggunakan nama kolom yang konsisten
            'selectedOption' => 'required',
            'price' => 'required|numeric',
            'date' => 'required|date',
            'time' => 'required',
            'pax' => 'required|integer',
            'location' => 'required|string',
            'locationDetail' => 'required|string',
            'user_id' => 'required|integer',
            'kode' => 'required|string',
            'product_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::transaction(function () use ($request) {
                // Update atau create data order
                $order = Order::updateOrCreate([
                    'user_id' => $request->user_id,
                    'product_type' => DocumentationService::class,
                    'product_id' => $request->product_id,
                ],[
                    'kode' => $request->kode,
                    'total' => $request->price,
                    'harga_jual' => $request->price,
                    'metode' => 2,
                    'status' => 'pending'
                ]);

                // Update atau create data order documentation service
                OrderDocumentationService::updateOrCreate([
                    'order_id' => $order->id,
                    'user_id' => $request->user_id,
                ],[
                    'documentation_services_id' => $request->documentation_services_id,
                    'dcumentation_prices_id' => $request->documentation_prices_id, // Menggunakan nama kolom yang benar
                    'selected_option' => $request->selectedOption,
                    'price' => $request->price,
                    'date' => $request->date,
                    'time' => $request->time,
                    'pax' => $request->pax,
                    'location' => $request->location,
                    'location_detail' => $request->locationDetail,
                    'payment_method' => 'midtrans',
                ]);
            });

            return response()->json([
                'message' => 'Order has been created',
                'data' => $request->all(),
            ]);
        } catch (\Exception $e) {
            // Mengembalikan error jika terjadi masalah pada DB::transaction
            return response()->json(['error' => 'Error creating order: ' . $e->getMessage()], 500);
        }
    }

    public function checkout(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'order_id' => 'required|exists:orders,id', // Pastikan order_id valid
        ]);

        // Ambil data order berdasarkan order_id
        $order = Order::findOrFail($request->order_id);

        // Update status order menjadi "waiting"
        $order->update(['status' => 'waiting']);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat parameter transaksi untuk Midtrans
        $transaction_details = [
            'order_id' => $order->kode,
            'gross_amount' => $order->total,
        ];

        $item_details = [
            [
                'id' => $order->product_id,
                'price' => $order->harga_jual,
                'quantity' => 1,
                'name' => $order->product_type,
            ]
        ];

        $customer_details = [
            'first_name' => $order->user->name,
            'email' => $order->user->email,
        ];

        // Buat payload untuk Snap Midtrans
        $snap_params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            // Dapatkan Snap token dari Midtrans
            $snapToken = Snap::createTransaction($snap_params)->redirect_url;

            // Simpan snap_token ke dalam order untuk referensi selanjutnya
            $order->update(['snap_token' => $snapToken]);

            // Kembalikan respons berisi URL VT-Web
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'message' => 'Order status updated to waiting and Snap token generated successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate Snap token. ' . $e->getMessage()
            ], 500);
        }
    }


}
