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

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
    // implement your reset password route here!
}]);

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'], function(){
	Route::get('/reset', 'AdminController@index');
	Route::get('/admin', 'AdminController@index');
	Route::get('/notestable', 'AdminController@showBottlestable');
	Route::get('/userstable', 'AdminController@showUserstable');

  Route::delete('/note/{id}', 'AdminController@destroyBottle');
	Route::delete('/user/{id}', 'AdminController@destroyUser');

});
