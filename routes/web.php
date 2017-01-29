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

Route::get('/', 'HomeController@index');
Route::get('/article/{id}', 'ArticleController@article');
Route::get('/blog', 'ArticleController@index');
Route::get('/blog/{id}', 'ArticleController@show');

Auth::routes();




Route::group(['middleware' => 'auth'], function () {

    // Super User
    Route::group(['middleware' => 'checkAdmin'], function () {

        Route::resource('category', 'CategoryController', []);
        Route::get('content/add', 'ContentController@addNew', []);
        Route::resource('content', 'ContentController', []);


    });

    // Normal User

});
