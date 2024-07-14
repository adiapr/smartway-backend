<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return "haha";
        $rents = Car::latest()->paginate(10);
        return view('admin.rent.index', compact('rents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'method' => 'POST',
            'url' => route('rent-car.store'),
            'location' => Location::all(),
        ];

        return view('admin.rent._form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['mileage'] = 1;
        // $data['location_id'] = json_encode($request->location_id);
        // return ;
        $car = Car::create($data);
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $car->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr()->success('Data berhasil ditambahkan');
        return redirect()->route('rent-car.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        // return $car;
        $data = [
            'item' => $car,
            'method' => 'PUT',
            'url' => route('rent-car.update', $car->id),
            'location' => Location::all(),
        ];

        return view('admin.rent._form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
        $data['mileage'] = 1;
        // $data['location_id'] = json_encode($request->location_id);
        // return ;
        $car = Car::findOrFail($id);
        $car->update($data);
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $car->clearMediaCollection('cover');
            $car->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr()->success('Data berhasil diperbarui');
        return redirect()->route('rent-car.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  Car::findOrFail($id);
        $data->delete();
        $data->media()->delete();

        if($data){
            return response()->json([
                "status" => "success",
                "message" => "Data Rental berhasil dihapus"
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Data gagal dihapus"
            ]);
        }
    }
}
