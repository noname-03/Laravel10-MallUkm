<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;


class ImageHelper
{
    public static function upload($file, $directory)
    {
        if ($file) {
            $fileName = uniqid() . '.' . $file->extension();
            $file->move(public_path($directory), $fileName);
            return $fileName;
        }

        return null;
    }
}