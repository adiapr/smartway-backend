<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DcumentationPrice;
use App\Models\DocumentationService;
use Illuminate\Http\Request;

class DocumentationServiceController extends Controller
{
    public function index()
    {
        $documentation = DocumentationService::with('media')->latest()->get();

        return $documentation;
    }

    public function show($slug)
    {
        $documentation = DocumentationService::where('slug', $slug)
        ->with('documentations.media')
        ->latest()
        ->firstOrFail();

        $groupedDocumentation = [
            'Atas' => [],
            'Bawah' => [],
            'result' => [],
        ];

        foreach ($documentation->documentations as $doc) {
            if (isset($groupedDocumentation[$doc->keterangan])) {
                $groupedDocumentation[$doc->keterangan][] = $doc;
            }
        }

        $formattedDocumentation = [
            'id' => $documentation->id,
            'name' => $documentation->name,
            'slug' => $documentation->slug,
            'description' => $documentation->description,
            'start_price' => "Rp." . number_format($documentation->start_price, 0, ',', '.') . ",-",
            'price' => "Rp." . number_format($documentation->price, 0, ',', '.') . ",-",
            'q1' => $documentation->q1,
            'q2' => $documentation->q2,
            'q3' => $documentation->q3,
            'q4' => $documentation->q4,
            'created_at' => $documentation->created_at,
            'updated_at' => $documentation->updated_at,
            'include1' => $documentation->include1,
            'include2' => $documentation->include2,
            'section2' => $documentation->section2,
            'description2' => $documentation->description2,
            'Atas' => $groupedDocumentation['Atas'],
            'Bawah' => $groupedDocumentation['Bawah'],
            'result' => $groupedDocumentation['result'],
        ];
        
        return $formattedDocumentation;
    }

    public function price($id)
    {
        return DcumentationPrice::with('documentation')->whereDocumentationServiceId($id)->get();
    }
}
