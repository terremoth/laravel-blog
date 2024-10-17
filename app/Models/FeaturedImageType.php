<?php

namespace App\Models;

enum FeaturedImageType : int
{
    case File = 1;
    case URL = 2;

    public static function getOptions() : array
    {
        return [
            self::File->value => __('As a file'),
            self::URL->value => __('As a URL')
        ];
    }
}
