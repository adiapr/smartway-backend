<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonyVideo;
use Illuminate\Http\Request;

class TestimonyVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'videos' => TestimonyVideo::latest()->paginate(10),
            'url' => route('content.testimony.store'),
            'method' => 'post',
        ];
        return view('admin.slider.testimony', $data);
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
        TestimonyVideo::create([
            'name' => $request->name,
            'publishment' => 'draft'
        ]);

        toastr()->success('Data berhasil ditambahkan');
        return redirect()->route('content.testimony.index');
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
            'videos' => TestimonyVideo::latest()->paginate(10),
            'url' => route('content.testimony.update', $id),
            'method' => 'put',
            'item' => TestimonyVideo::findOrFail($id)
        ];

        return view('admin.slider.testimony', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        TestimonyVideo::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        toastr()->success('Data berhasil diperbarui');
        return back();        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  TestimonyVideo::findOrFail($id);
        $data->delete();

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
