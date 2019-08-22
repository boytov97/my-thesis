<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('admin.common.menu', 'App\Http\ViewComposers\Admin\MenuComposer');
        View::composer('admin.category.form', 'App\Http\ViewComposers\Admin\CategoriesComposer');
        View::composer(['admin.images.form', 'admin.grammar.form'], 'App\Http\ViewComposers\Admin\GrammarCategoriesComposer');
        View::composer('admin.tests.form', 'App\Http\ViewComposers\Admin\TestsCategoriesComposer');
        View::composer('admin.blog.form', 'App\Http\ViewComposers\Admin\BlogCategoriesComposer');
        View::composer(['admin.exe_category.form', 'admin.exe_category.list'], 'App\Http\ViewComposers\Admin\GrammarsComposer');
        View::composer('admin.exercise.form', 'App\Http\ViewComposers\Admin\ExeCategoriesComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}