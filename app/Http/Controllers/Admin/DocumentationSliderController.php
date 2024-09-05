<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DcumentationPrice;
use App\Models\Documentation;
use App\Models\DocumentationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Node\Block\Document;

class DocumentationSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($documentation_id)
    {
        $data = [
            'method' => 'POST',
            'documentation' => DocumentationService::findOrfail($documentation_id),
            'sliders' => Documentation::with('media')->wheredocumentationsType(DocumentationService::class)->whereDocumentationsId($documentation_id)->latest()->get(),
        ];

        // return $data['sliders'];
        return view('admin.documentation.slider', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $documentation_id)
    {

        DB::transaction(function () use ($request, $documentation_id){
            $store = Documentation::create([
                'documentations_type' => DocumentationService::class,
                'documentations_id' => $documentation_id,
                'keterangan' => $request->position
            ]);
    
            $store->addMediaFromRequest('cover')->toMediaCollection('cover');
        });

        toastr()->success('Data berhasil ditambahkan');
        return back();


    }

    public function result($documentation_id)
    {
        $documentation = DocumentationService::findOrFail($documentation_id);
        $data = [
            'documentation' => $documentation,
            'result' => Documentation::with('media')->wheredocumentationsType(DocumentationService::class)->whereDocumentationsId($documentation_id)->whereKeterangan('result')->latest()->get(),
        ];

        return view('admin.documentation.result', $data);
    }

    public function store_result(Request $request, $documentation_id)
    {
        DB::transaction(function () use ($request, $documentation_id){
            $store = Documentation::create([
                'documentations_type' => DocumentationService::class,
                'documentations_id' => $documentation_id,
                'keterangan' => 'result',
                'description' => $request->description,
            ]);
    
            $store->addMediaFromRequest('cover')->toMediaCollection('cover');
        });

        toastr()->success('Data berhasil ditambahkan');
        return back();
    }

    public function store_header(Request $request, $id)
    {
        DocumentationService::findOrFail($id)->update([
            'section2' => $request->section2,
            'description2' => $request->description2,
        ]);

        toastr()->success('Data berhasil ditambahkan');
        return back();
    }

    public function price($documentation_id)
    {
        $documentation = DocumentationService::findOrFail($documentation_id);
        $data = [
            'documentation' => $documentation,
            'prices' => DcumentationPrice::whereDocumentationServiceId($documentation_id)->get(),
        ];

        return view('admin.documentation.price', $data);
    }

    public function update_or_create_price(Request $request, $documentation_id)
    {
        $attr = $request->except('_token');
        
        // return $attr;
        
        if(@$request->id){
            DcumentationPrice::findOrFail($request->id)->update($attr);
        } else {
            $attr['documentation_service_id'] = $documentation_id;
            DcumentationPrice::create($attr);
        }

        toastr()->success('Data berhasil ditambahkan');
        return back();
    }

    public function delete_price(string $id)
    {
        $data = DcumentationPrice::findOrFail($id);
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
