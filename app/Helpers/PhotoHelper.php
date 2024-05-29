<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoHelper
{
    public static function formatPhoto($module, $photo)
    {
        $pre = $photo == "default.jpg" ? "storage/".$module."/" : "";
        return '<img src="' . asset($pre . $photo) . '" alt="Photo" width="50" height="50">';
    }

    public static function submitPhoto($module, $request)
    {
        if ($request->hasFile('photo')) {
            // Verificar si la carpeta existe, si no, crearla
            if (!Storage::disk('public')->exists($module)) {
                Storage::disk('public')->makeDirectory($module);
            }

            $file = $request->file('photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/'. $module , $filename);
            return 'storage/'. $module .'/' . $filename;
        }

        return "default.jpg";
    }

    public static function updatePhoto($data, $module, $request)
    {
        if ($request->hasFile('photo')) {
            // Verificar si la carpeta existe, si no, crearla
            if (!Storage::disk('public')->exists($module)) {
                Storage::disk('public')->makeDirectory($module);
            }

            // Eliminar la imagen anterior si existe
            if ($data->photo && $data->photo != "default.jpg") {
                Storage::disk('public')->delete($data->photo);
            }

            $file = $request->file('photo');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/'.$module, $filename);
            return 'storage/'.$module.'/' . $filename;
        }

        return $data->photo;
    }
}
