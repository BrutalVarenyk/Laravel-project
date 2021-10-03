<?php

namespace App\Services\Images;

interface ImageServiceInterface
{
    public static function upload($image): string;
    public static function remove($image);

}
