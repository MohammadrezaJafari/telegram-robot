<?php
//
///*
//|--------------------------------------------------------------------------
//| Routes File
//|--------------------------------------------------------------------------
//|
//| Here is where you will register all of the routes in an application.
//| It's a breeze. Simply tell Laravel the URIs it should respond to
//| and give it the controller to call when that URI is requested.
//|
//*/
//
//Route::get('/sample', "UserController@getIndex");
////
Route::get('/', function () {
    
});
//Route::group(['middleware' => ['web','authorize']], function () {
//    Route::resource('content', 'ContentController');
//    Route::get('api/content', array('as'=>'api.products', 'uses'=>'ContentController@getTable'));
//});
//
///*
//|--------------------------------------------------------------------------
//| Application Routes
//|--------------------------------------------------------------------------
//|
//| This route group applies the "web" middleware group to every route
//| it contains. The "web" middleware group is defined in your HTTP
//| kernel and includes session state, CSRF protection, and more.
//|
//*/
//Route::group(['middleware' => ['web','auth']], function () {
//    Route::auth();
//
//    Route::group(['prefix' => 'domain'], function () {
//        Route::auth();
//        Route::get('/dashboard','AdminController@getIndex');
//
//        Route::resource('order', 'OrderController');
//        Route::get('api/orders', array('as'=>'api.orders', 'uses'=>'OrderController@getTable'));
//
//        Route::resource('slide', 'SlideController');
//        Route::get('api/slides', array('as'=>'api.slides', 'uses'=>'SlideController@getTable'));
//
//        Route::resource('gallery', 'GalleryController');
//        Route::get('api/galleries', array('as'=>'api.galleries', 'uses'=>'GalleryController@getTable'));
//
//        Route::resource('content', 'ContentController');
//        Route::get('api/contents', array('as'=>'api.pages', 'uses'=>'ContentController@getTable'));
//
//    });}
//);
Route::group(['prefix' => 'auth','middleware' => ['web']], function () {
    Route::auth();
    Route::controller('/','HomeController');
});
