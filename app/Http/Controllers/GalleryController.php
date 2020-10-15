<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $dir = 'public/images';
        $path = $file->store($dir);
        return "/storage/images/".str_replace("$dir/", "", $path);
    }

    public function clearFile(Request $request)
    {
        $path = $request->path;
        \Storage::disk('public')->delete(str_replace("/storage", "", $path));
        Gallery::wherePath($path)->delete();
        return ['path' => $path];
    }
}
