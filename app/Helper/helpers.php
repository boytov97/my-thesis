<?php

use App\Facades\Widget;

if (!function_exists('widget')) {
    function widget($slug)
    {
        return Widget::get($slug);
    }
}