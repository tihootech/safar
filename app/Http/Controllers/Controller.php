<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Gallery;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function deleteFiles($request)
    {
        if ($request->deletefiles && count($request->deletefiles)) {
            Gallery::WhereIn('path', $request->deletefiles)->delete();
            foreach ($request->deletefiles as $path) {
                \Storage::disk('public')->delete(str_replace("/storage", "", $path));
            }
        }
    }

    public static function deleteRows($request, $class)
    {
        if ($request->deletelist && count($request->deletelist)) {
            $class::WhereIn('id', $request->deletelist)->delete();
        }
    }
}
