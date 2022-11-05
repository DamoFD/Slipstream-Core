<?php

namespace App\Helpers;

class FileHelper
{
    public static function isVideo($media)
    {
        if(str_contains(self::getType($media), "video/")){
            return true;
        }
    }

    public static function isImage($media)
    {
        if(str_contains(self::getType($media), "image/")){
            return true;
        }
    }

    public static function getType($media)
    {
        return mime_content_type($media);
    }
}
