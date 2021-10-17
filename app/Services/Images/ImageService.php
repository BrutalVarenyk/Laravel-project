<?php

namespace App\Services\Images;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService implements ImageServiceInterface
{

    public static function upload($image): string
    {
        if (is_null($image)) {
            return '';
        }

        if ($is_string = is_string($image)) {
            $imageData = explode('.', $image );
        }

        // create path with random 3 directory and random name of image file
        $imagePath = 'public/' . implode('/', str_split(Str::random(8), 2))
            . '/'
            . Str::random(16)
            . '.'
            . (!$is_string ? $image->getClientOriginalExtension() : $imageData[1]);

        // save image with our random unique path
//        Storage::put(
//            $imagePath,
//            Storage::url($image)
//        );

        Storage::put(
            $imagePath,
            File::get($image)
        );

        return $imagePath;
    }

    public static function remove($image)
    {
        Storage::delete($image);

        $path = explode('/', $image);
        array_pop($path);

        $FileSystem = new Filesystem();

        while ($path[array_key_last($path)] !== 'public')
        {
            // Target directory.
            $directory = storage_path() . '/app/' . implode('/', $path);

            // Check if the directory exists.
            if ($FileSystem->exists($directory)) {

                // Get all files in this directory.
                $files = $FileSystem->files($directory);

                // Check if directory is empty.
                if (empty($files)) {
                    // Yes, delete the directory.
                    $FileSystem->deleteDirectory($directory);

                    array_pop($path);
                }else{
                    break;
                }
            }else{
                break;
            }
        }
    }
}
