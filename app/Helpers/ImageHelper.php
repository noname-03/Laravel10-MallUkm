<?php

namespace App\Helpers;

// use Illuminate\Support\Facades\Storage;
use File;


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

    //delete
    public static function delete($fileName, $directory)
    {
        //with delete file in public mwith methode File
        File::delete(public_path($directory . '/' . $fileName));
    }
}