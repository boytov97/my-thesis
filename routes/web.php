<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/grammar/{slug?}', 'GrammarController@index')->name('grammar.index');

    Route::get('/grammar/exercise/{id}', 'ExerciseController@index')->name('exercise.index');
    Route::post('/grammar/exercise/{id}/check', 'ExerciseController@check')->name('exercise.check');

    Route::get('/video', 'VideoController@index')->name('video.index');
    Route::get('/video/{id}', 'VideoController@show')->name('video.show');
    Route::post('/video/add-commit', 'VideoCommitsController@store')->name('video.commit');

    Route::get('/tests/', 'TestController@index')->name('tests.index');
    Route::get('/tests/{slug}', 'TestController@showTestByCategorySlug')->name('tests.show');
    Route::post('/tests/{id}/check', 'TestController@check')->name('tests.check');

    Route::get('/images/{slug?}', 'ImagesController@index')->name('images.index');

    Route::get('/blog/{slug?}', 'BlogController@index')->name('blog.index');
    Route::get('/blog/{slug}/{id}', 'BlogController@show')->name('blog.show');

    Route::get('/profile/{id}/{tag?}', 'Auth\ProfileController@showTags')->name('profile.index');
    Route::post('/profile/{id}/my_form', 'Auth\ProfileController@update')->name('profile.update');
    Route::post('/profile/{id}/reset', 'Auth\ProfileController@updatePassword')->name('profile.reset_pass');

    Route::get('/feedback', 'FeedbackController@index')->name('feedback.index');
});

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function() {
    Route::get('/', 'Nimda\AdminController@admin')->name('admin');

    Route::get('/admins', 'Nimda\AdminsController@index')->name('admins');
    Route::get('/admins/{id}/edit', 'Nimda\AdminsController@edit')->middleware('is_super_admin')->name('admins_edit');
    Route::post('/admins/{id}/update', 'Nimda\AdminsController@update')->name('admins_update');

    Route::get('/widgets', 'Nimda\WidgetsController@index')->name('admin_widgets');
    Route::get('/widgets/create', 'Nimda\WidgetsController@create')->name('admin_widgets_create');
    Route::post('/widgets/store', 'Nimda\WidgetsController@store')->name('admin_widgets_store');
    Route::match(['get', 'post'], '/widgets/{id}/update', 'Nimda\WidgetsController@update')->name('admin_widgets_update');
    Route::get('/widgets/{id}/edit', 'Nimda\WidgetsController@edit')->name('admin_widgets_edit');
    Route::get('/widgets/{id}/destroy', 'Nimda\WidgetsController@destroy')->name('admin_widgets_destroy');

    Route::get('/images', 'Nimda\ImagesController@index')->name('admin_images');
    Route::get('/images/create', 'Nimda\ImagesController@create')->name('admin_images_create');
    Route::post('/images/store', 'Nimda\ImagesController@store')->name('admin_images_store');
    Route::match(['get', 'post'], '/images/{id}/update', 'Nimda\ImagesController@update')->name('admin_images_update');
    Route::get('/images/{id}/edit', 'Nimda\ImagesController@edit')->name('admin_images_edit');
    Route::get('/images/{id}/destroy', 'Nimda\ImagesController@destroy')->name('admin_images_destroy');
    Route::get('/images/{id}/destroyUpload', 'Nimda\ImagesController@destroyUpload')->name('admin_images_destroyUpload');

    Route::get('/slider', 'Nimda\SliderController@index')->name('admin_slider');
    Route::get('/slider/create', 'Nimda\SliderController@create')->name('admin_slider_create');
    Route::post('/slider/store', 'Nimda\SliderController@store')->name('admin_slider_store');
    Route::match(['get', 'post'], '/slider/{id}/update', 'Nimda\SliderController@update')->name('admin_slider_update');
    Route::get('/slider/{id}/edit', 'Nimda\SliderController@edit')->name('admin_slider_edit');
    Route::get('/slider/{id}/destroy', 'Nimda\SliderController@destroy')->name('admin_slider_destroy');
    Route::get('/slider/{id}/destroyUpload', 'Nimda\SliderController@destroyUpload')->name('admin_slider_destroyUpload');

    Route::get('/address', 'Nimda\FeedbackController@index')->name('admin_address');
    Route::get('/address/create', 'Nimda\FeedbackController@create')->name('admin_address_create');
    Route::post('/address/store', 'Nimda\FeedbackController@store')->name('admin_address_store');
    Route::match(['get', 'post'], '/address/{id}/update', 'Nimda\FeedbackController@update')->name('admin_address_update');
    Route::get('/address/{id}/edit', 'Nimda\FeedbackController@edit')->name('admin_address_edit');
    Route::get('/address/{id}/destroy', 'Nimda\FeedbackController@destroy')->name('admin_address_destroy');

    Route::get('/grammar', 'Nimda\GrammarController@index')->name('admin_grammar');
    Route::get('/grammar/create', 'Nimda\GrammarController@create')->name('admin_grammar_create');
    Route::post('/grammar/store', 'Nimda\GrammarController@store')->name('admin_grammar_store');
    Route::match(['get', 'post'], '/grammar/{id}/update', 'Nimda\GrammarController@update')->name('admin_grammar_update');
    Route::get('/grammar/{id}/edit', 'Nimda\GrammarController@edit')->name('admin_grammar_edit');
    Route::get('/grammar/{id}/destroy', 'Nimda\GrammarController@destroy')->name('admin_grammar_destroy');
    Route::get('/grammar/{id}/destroyUpload', 'Nimda\GrammarController@destroyUpload')->name('admin_grammar_destroyUpload');

    Route::get('/exercise', 'Nimda\ExerciseController@index')->name('admin_exercise');
    Route::get('/exercise/create', 'Nimda\ExerciseController@create')->name('admin_exercise_create');
    Route::post('/exercise/store', 'Nimda\ExerciseController@store')->name('admin_exercise_store');
    Route::match(['get', 'post'], '/exercise/{id}/update', 'Nimda\ExerciseController@update')->name('admin_exercise_update');
    Route::get('/exercise/{id}/edit', 'Nimda\ExerciseController@edit')->name('admin_exercise_edit');
    Route::get('/exercise/{id}/destroy', 'Nimda\ExerciseController@destroy')->name('admin_exercise_destroy');

    Route::get('/tests', 'Nimda\TestsController@index')->name('admin_tests');
    Route::get('/tests/create', 'Nimda\TestsController@create')->name('admin_tests_create');
    Route::post('/tests/store', 'Nimda\TestsController@store')->name('admin_tests_store');
    Route::match(['get', 'post'], '/tests/{id}/update', 'Nimda\TestsController@update')->name('admin_tests_update');
    Route::get('/tests/{id}/edit', 'Nimda\TestsController@edit')->name('admin_tests_edit');
    Route::get('/tests/{id}/destroy', 'Nimda\TestsController@destroy')->name('admin_tests_destroy');

    Route::get('/blog', 'Nimda\BlogController@index')->name('admin_blog');
    Route::get('/blog/create', 'Nimda\BlogController@create')->name('admin_blog_create');
    Route::post('/blog/store', 'Nimda\BlogController@store')->name('admin_blog_store');
    Route::match(['get', 'post'], '/blog/{id}/update', 'Nimda\BlogController@update')->name('admin_blog_update');
    Route::get('/blog/{id}/edit', 'Nimda\BlogController@edit')->name('admin_blog_edit');
    Route::get('/blog/{id}/destroy', 'Nimda\BlogController@destroy')->name('admin_blog_destroy');
    Route::get('/blog/{id}/destroyUpload', 'Nimda\BlogController@destroyUpload')->name('admin_blog_destroyUpload');

    Route::get('/video', 'Nimda\VideoController@index')->name('admin_video');
    Route::get('/video/create', 'Nimda\VideoController@create')->name('admin_video_create');
    Route::post('/video/store', 'Nimda\VideoController@store')->name('admin_video_store');
    Route::match(['get', 'post'], '/video/{id}/update', 'Nimda\VideoController@update')->name('admin_video_update');
    Route::get('/video/{id}/edit', 'Nimda\VideoController@edit')->name('admin_video_edit');
    Route::get('/video/{id}/destroy', 'Nimda\VideoController@destroy')->name('admin_video_destroy');
    Route::get('/video/{id}/destroyUpload', 'Nimda\VideoController@destroyUpload')->name('admin_video_destroyUpload');
    Route::get('/video/{id}/destroy-poster-upload', 'Nimda\VideoController@destroyPosterUpload')->name('admin_video_destroyPosterUpload');

    Route::get('/category', 'Nimda\CategoryController@index')->name('admin_category');
    Route::get('/category/create', 'Nimda\CategoryController@create')->name('admin_category_create');
    Route::post('/category/store', 'Nimda\CategoryController@store')->name('admin_category_store');
    Route::match(['get', 'post'], '/category/{id}/update', 'Nimda\CategoryController@update')->name('admin_category_update');
    Route::get('/category/{id}/edit', 'Nimda\CategoryController@edit')->name('admin_category_edit');
    Route::get('/category/{id}/destroy', 'Nimda\CategoryController@destroy')->name('admin_category_destroy');

    Route::get('/exe-category', 'Nimda\ExeCategoryController@index')->name('admin_exe_category');
    Route::get('/exe-category/create', 'Nimda\ExeCategoryController@create')->name('admin_exe_category_create');
    Route::post('/exe-category/store', 'Nimda\ExeCategoryController@store')->name('admin_exe_category_store');
    Route::match(['get', 'post'], '/exe-category/{id}/update', 'Nimda\ExeCategoryController@update')->name('admin_exe_category_update');
    Route::get('/exe-category/{id}/edit', 'Nimda\ExeCategoryController@edit')->name('admin_exe_category_edit');
    Route::get('/exe-category/{id}/destroy', 'Nimda\ExeCategoryController@destroy')->name('admin_exe_category_destroy');
});
