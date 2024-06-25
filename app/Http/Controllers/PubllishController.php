<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PubllishController extends Controller
{
    public function published(Request $request)
    {
        try {

            if ($request->ajax()) {
                DB::table($request->table)->where('id', $request->id)->update([
                    'publishment' => $request->value,
                ]);

                if ($request->value == 'published') {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Publish successfully',
                        'publish' => $request->value,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Unpublish successfully',
                        'publish' => $request->value,
                    ]);
                }
            }
        } catch (\Throwable $th) {

            if (!app()->isProduction()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage(),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan pada server, coba lagi',
                ]);
            }
        }
    }
}
