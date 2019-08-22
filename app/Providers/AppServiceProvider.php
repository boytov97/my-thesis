<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('slider.slider', 'App\Http\ViewComposers\SliderComposer');
        View::composer('home', 'App\Http\ViewComposers\CardsComposer');
        View::composer(['grammar.side_menu', 'grammar.hid_side_menu'], 'App\Http\ViewComposers\GrammarCategoriesComposer');
        View::composer(['test.side_menu', 'test.hid_side_menu'], 'App\Http\ViewComposers\TestCategoriesComposer');
        View::composer(['blog.side_menu', 'blog.hid_side_menu'], 'App\Http\ViewComposers\BlogCategoriesComposer');
        View::composer('common.header', 'App\Http\ViewComposers\LastCategoryComposer');
    }
}
