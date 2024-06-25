<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourPrice;
use Illuminate\Http\Request;

class WisataPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($uuid)
    {
        $tour = Tour::whereUuid($uuid)->firstOrFail();
        $data = [
            'tour' => $tour,
            'prices' => TourPrice::whereTourId($tour->id)->latest()->get(),
        ];
        // return $data['prices'];
        return view('admin.tours.price', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $uuid)
    {
        $tour = Tour::whereUuid($uuid)->firstOrFail();
        $data = $request->except('_token');
        $data['tour_id'] = $tour->id;

        TourPrice::create($data);

        toastr()->success('Harga berhasil ditambahkan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
        TourPrice::findOrFail($id)->update($data);

        toastr()->success('Harga berhasil diperbarui');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TourPrice::findOrFail($id);
        $data->delete();

        if ($data) {
            return response()->json([
                "status" => "success",
                "message" => "Data Berhasil Dihapus !"
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Data Gagal Dihapus !"
            ]);
        }
    }
}
