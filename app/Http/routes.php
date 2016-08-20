<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
define('ADMIN_PREFIX', 'admin');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => ADMIN_PREFIX, 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);
    Route::resource('users', 'UsersController');
    Route::resource('groups', 'GroupsController');
    Route::get('/config/overtime', ['as' => 'config.overtime', 'uses' => 'ConfigController@overtime']);
    Route::post('/config/update-overtime', ['as' => 'config.updateOvertime', 'uses' => 'ConfigController@updateOvertime']);
});
//Route::group(['middleware' => ['user'], function () {
//    Route::get('/', ['as' => 'main', 'uses' => 'MainController@index']);
//}]);
Route::group(['middleware' => 'user'], function () {
    Route::get('/', ['as' => 'main', 'uses' => 'MainController@index']);
    Route::get('/user/profile', ['as' => 'user.profile', 'uses' => 'Admin\UsersController@editProfile']);
    Route::put('/user/update-profile', ['as' => 'user.updateProfile', 'uses' => 'Admin\UsersController@updateProfile']);
});

Route::get(ADMIN_PREFIX . '/login', ['as' => 'admin.login', 'uses' => 'Admin\AdminController@getLogin']);
Route::post(ADMIN_PREFIX . '/postLogin', ['as' => 'admin.postLogin', 'uses' => 'Admin\AdminController@postLogin']);
Route::get(ADMIN_PREFIX . '/logout', ['as' => 'admin.getLogout', 'uses' => 'Admin\AdminController@getLogout']);
Route::get(ADMIN_PREFIX . '/lost-password', ['as' => 'admin.lostPassword', 'uses' => 'Admin\AdminController@lostPassword']);
Route::post(ADMIN_PREFIX . '/reset-password', ['as' => 'admin.resetPassword', 'uses' => 'Admin\AdminController@resetPassword']);

Route::group(['middleware' => 'active'], function () {
    Route::get('/users/active', ['as' => 'user.active', 'uses' => 'Admin\UsersController@active']);
    Route::post('/users/activeUser', ['as' => 'user.activeUser', 'uses' => 'Admin\UsersController@activeUser']);
});
Route::get('/login', ['as' => 'user.login', 'uses' => 'Admin\UsersController@getLogin']);
Route::post('/postLogin', ['as' => 'user.postLogin', 'uses' => 'Admin\UsersController@postLogin']);
Route::get('/logout', ['as' => 'user.getLogout', 'uses' => 'Admin\UsersController@getLogout']);
