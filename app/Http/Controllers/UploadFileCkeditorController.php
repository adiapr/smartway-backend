<?php

namespace App\Http\Controllers;

use App\Actions\UploadMediaAction;
use Illuminate\Http\Request;

class UploadFileCkeditorController extends Controller
{
    public $mediaAction;

    public function __construct()
    {
        $this->mediaAction = new UploadMediaAction();
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->hasFile('upload')) {
            $request->validate([
                'upload' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $file = $request->file('upload');
            $path = $this->mediaAction->store('editor', $file);
            $url = $this->mediaAction->url($path);

            return response()->json(['fileName' => $path, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
