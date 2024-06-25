<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CKEditorController extends Controller
{
    public function uploadFile(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image files
        ]);

        // Retrieve the uploaded file
        $uploadedImage = $request->file('upload');

        // Generate a unique filename to prevent collisions
        $filename = Str::uuid() . '.' . $uploadedImage->getClientOriginalExtension();

        // Move the uploaded file to the storage directory
        $uploadedImage->move(public_path('uploads'), $filename);

        // Generate the URL for the uploaded file
        $imageUrl = asset('uploads/' . $filename);

        // Return the URL of the uploaded image in the expected JSON format
        return response()->json([
            'uploaded' => true,
            'url' => $imageUrl
        ]);
    }
}
