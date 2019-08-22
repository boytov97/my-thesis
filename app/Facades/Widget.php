<?php

namespace App\Facades;

use App\Widgets as Model;

class Widget
{
    protected static $widgets = [];

    /**
     * Получение значения виджета по ключу.
     *
     * @param string $slug
     *
     * @return string|null
     */
    public static function get(string $slug)
    {
        if (!array_key_exists($slug, self::$widgets)) {
            $content = Model::active()->where('slug', $slug)->value('content');
            self::$widgets[$slug] = $content;
        }

        return self::$widgets[$slug];
    }
}
