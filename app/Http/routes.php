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
//Public//////////////////
//baseC
Route::get('/', ['as' => 'home', 'uses' => 'Base\BaseController@indexAction']);
Route::get('/fishes', 'Base\BaseController@fishesAction');
Route::get('/fishes/{arg1}', 'Base\BaseController@fishInfoAction');
Route::get('/news', 'Base\BaseController@newsAction');
Route::get('/about', 'Base\BaseController@aboutAction');
Route::get('/contacts', 'Base\BaseController@contactsAction');
Route::get('/aaa', 'Base\BaseController@aaaAction');
Route::get('/bbb', 'Base\BaseController@bbbAction');
Route::get('/forum/{topic}', 'Base\BaseController@forumAction');
Route::get('/forum', 'Base\BaseController@forumBaseAction');

//admC
Route::get('/register', ['as' => 'user-registration', 'uses' => 'Base\AuthController@getRegisterAction']);
Route::post('/register', ['uses' => 'Base\AuthController@postRegisterAction']);
Route::get('/login', ['as' => 'user-login', 'uses' => 'Base\AuthController@getLoginAction']);
Route::post('/login', ['uses' => 'Base\AuthController@postLoginAction']);
Route::get('/logout', 'Base\AuthController@logoutAction');




//Admin////////////////////
//baseC
Route::get('/admin', ['as' => 'admin', 'uses' => 'Admin\BaseController@indexAction']);
Route::get('/admin/contents', 'Admin\BaseController@contentManagementAction');
Route::get('/admin/users', 'Admin\BaseController@usersManagementAction');
Route::get('/admin/statistics', 'Admin\BaseController@siteStatisticsAction');

Route::get('/admin/contents/home', 'Admin\BaseController@homeEditingAction');
Route::get('/admin/contents/forum', 'Admin\BaseController@forumEditingAction');
Route::get('/admin/contents/fishes', 'Admin\BaseController@fishesEditingAction');
Route::get('/admin/contents/about', 'Admin\BaseController@aboutEditingAction');
Route::get('/admin/contents/contacts', 'Admin\BaseController@contactsEditingAction');

//admC
Route::get('/admin/register', 'Admin\AuthController@getRegisterAction');
Route::post('/admin/register', 'Admin\AuthController@postRegisterAction');
Route::get('/admin/login', 'Admin\AuthController@getLoginAction');
Route::post('/admin/login', 'Admin\AuthController@postLoginAction');
Route::get('/admin/logout', 'Admin\AuthController@logoutAction');