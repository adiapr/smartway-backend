<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'sliders' => Slider::latest()->paginate(10),
            'url' => route('content.slider.store'),
            'method' => 'post',
        ];
        return view('admin.slider.index', $data);
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
    public function store(Request $request)
    {

        $request->validate([
            'cover' => 'required',
        ]);

        $data = $request->except('_token');
        $data['publishment'] = 'draft';
        $slider = Slider::create($data);
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $slider->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr()->success('Data berhasil ditambahkan');
        return redirect()->route('content.slider.index');
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
        $data = [
            'sliders' => Slider::latest()->paginate(10),
            'url' => route('content.slider.update', $id),
            'method' => 'put',
            'item' => Slider::findOrFail($id)
        ];
        return view('admin.slider.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $request->except('_token');
        $slider->update($data);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $slider->clearMediaCollection('cover');
            $slider->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr()->success('Data berhasil diperbarui');
        return redirect()->route('content.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  Slider::findOrFail($id);
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
