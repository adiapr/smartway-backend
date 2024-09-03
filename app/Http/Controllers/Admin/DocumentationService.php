<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentationService as ModelsDocumentationService;
use Illuminate\Http\Request;

class DocumentationService extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentations = ModelsDocumentationService::latest()->get();
        return view('admin.documentation.index', compact('documentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'url' => route('documentation.store'),
            'method' => 'POST'
        ];
        return view('admin.documentation._form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $documentation = ModelsDocumentationService::create($data);
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $documentation->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr()->success('Data berhasil diperbatui');
        return redirect()->route('documentation.index');
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
        $documentation = ModelsDocumentationService::findOrFail($id);
        $data = [
            'url' => route('documentation.update', $documentation->id),
            'method' => 'PUT',
            'item' => $documentation
        ];
        return view('admin.documentation._form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
        $documentation = ModelsDocumentationService::findOrFail($id);
        $documentation->update($data);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $documentation->clearMediaCollection('cover');
            $documentation->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        toastr()->success('Data berhasil diperbatui');
        return redirect()->route('documentation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ModelsDocumentationService::findOrFail($id);
        $data->delete();
        $data->media()->delete();

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
