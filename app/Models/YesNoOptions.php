<?php

namespace App\Models;

class YesNoOptions
{
    public static function getOptions() : array
    {
        return ['1' => __('Yes'), '0' => __('No')];
    }
}
