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
$subDomainApp = config('app.subdomain_app');
$subDomainPortal = config('app.subdomain_portal');
$subDirectory = config('app.sub_directory');
$subDomainClient = config('app.subdomain_client');

Route::group(['prefix' => $subDirectory], function () {
    Route::group(['prefix' => 'v1/'], function () {
        Route::namespace('Web')->group(function () {
            // Route::get('', 'AuthController@showLoginForm')->name('client.login');
            // Route::post('', 'AuthController@login')->name('client.post.login');
            Route::get('/home/video', 'HomeController@index');
            Route::get('/category/{cateSlug}', 'HomeController@getMovieWithCategorySlug');
            Route::get('/movie/{slug}', 'HomeController@show');
            Route::post('/access-key', 'HomeController@createFileAccessKey');

            Route::middleware(['checkingToken','auth:client'])->group(function () {
                
            });
        });
    });
});
