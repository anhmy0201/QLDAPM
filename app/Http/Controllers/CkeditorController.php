<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            
            $url = asset('storage/' . $path);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'Không thể upload file.']]);
    }
}
?>