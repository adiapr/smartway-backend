<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'method' => 'POST',
            'url' => route('faq.store'),
            'data' => Faq::all(),
        ];

        return view('admin.faq.index', $data);
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
        Faq::create($request->except('_token'));
        toastr()->success('Data berhasil ditambahkan');

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
        $data = [
            'method' => 'PUT',
            'url' => route('faq.update', $id),
            'data' => Faq::all(),
            'faq' => Faq::findOrFail($id),
        ];

        return view('admin.faq.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Faq::findOrFail($id)->update($request->except('_token'));
        toastr()->success('Data berhasil diperbatui');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  Faq::findOrFail($id)->delete();

        if($data){
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dihapus"
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Data gagal dihapus"
            ]);
        }
    }

    public function api()
    {
        $data = Faq::all();
        return $data;
    }
}
