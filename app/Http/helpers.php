<?php

use App\Models\Category;

if (!function_exists('dateFormat')) {
    function dateFormat($date): string
    {
        return !is_numeric($date)
            ? Jenssegers\Date\Date::parse($date)->format('j F Y')
            : '---';
    }
}


