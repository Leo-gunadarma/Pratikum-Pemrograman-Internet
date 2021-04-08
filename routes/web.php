<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['verify' => true, 'guest']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin');

Route::middleware('admin:admin')->group(function(){
  Route::get('/admin', function(){
  	return view('auth.dashboard_admin');
    
  });
  //List Route yang digunakan untuk CRUD Admin
  Route::resource('/product','ControllerProduct');
  Route::resource('/product-category','ControllerProductCategory');
  Route::resource('/courier','ControllerCourier');
  Route::get('admin/logout', 'Auth\AdminAuthController@postLogout');
});

Route::get('/user', 'UserController@index');