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

Route::get('/', 'BerandaController@index');
Route::get('/product/detail/{id}', 'BerandaController@detail');

//Add to cart
Route::get('/add-to-cart/{id}', 'BerandaController@addToCart');

//Product berdasarkan category
Route::get('/product/category/{id}', 'BerandaController@category');

// Get cart/Tampilkan cart
Route::get('/shopping-cart', 'CartController@index');

// Kosongkan Keranjang
Route::get('/shopping-cart/destroy', 'CartController@destroy');

//Tambah qty item di keranjang
Route::get('/shopping-cart/update/{id}', 'CartController@tambahkan');

//Kurangi qty item di keranjang
Route::get('/shopping-cart/kurangi/{id}', 'CartController@kurangi');










Auth::routes(['verify' => true, 'guest']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin');
Route::get('admin/logout', 'Auth\AdminAuthController@postLogout');


Route::middleware('admin:admin')->group(function(){
  Route::get('/admin', function(){
  	return view('auth.dashboard_admin');
  });

  Route::get('/logout', function(){
    return redirect('/');
  });


// =============== KONFIRMASI PEMBAYARAN ===========================================================
  Route::get('/konfirmasi-admin', 'KonfirmasiAdmController@index');
  // Detail Konfirmasi
  Route::get('/konfirmasi/detail/{id}', 'KonfirmasiAdmController@detail');
  // Terima Konfirmasi
  Route::get('/konfirmasi/terima/{pesanan_id}', 'KonfirmasiAdmController@terima');
  // Tolak Konfirmasi
  Route::get('/konfirmasi/tolak/{pesanan_id}', 'KonfirmasiAdmController@tolak');

  // ========================= LIST PESANAN =================================
  Route::get('/pesanan', 'PesananController@index');



//List Route yang digunakan untuk CRUD Admin
  Route::resource('/product','ControllerProduct');

  //--Route Untuk Soft Delete pada Admin Product--//
    //route get all data trash product
    Route::get('/product-trash','ControllerProduct@trash');
    //route restore product
    Route::get('/product-restore/{id}', 'ControllerProduct@restore');
    Route::get('/product-restore-all', 'ControllerProduct@restore_all');
    //route hapus permanen
    Route::get('/product-hapus_permanen/{id}', 'ControllerProduct@hapus');
    Route::get('/product-hapus_permanen', 'ControllerProduct@hapus_semua');
  //-- End Route Untuk Soft Delete pada Admin Product --//

  //--Route untuk diskon--//

    Route::get('/discount/{id}','ControllerDiscount@discount');
    Route::post('/discount-store','ControllerDiscount@store');
    Route::put('/discount-update/{id}','ControllerDiscount@update');
    Route::get('/discount-delete/{id}','ControllerDiscount@delete');
    
  //--End route untuk diskon--//

  Route::resource('/product-category','ControllerProductCategory');

    //--Route untuk soft delete admin product category--//

    //-- End Route untuk soft delete admin product category --//
  
  Route::resource('/courier','ControllerCourier');
  Route::get('/gambar/{id}','ControllerProduct@editGambar');
  Route::match(['put', 'patch'],'/gambar/{id}/update', 'ControllerProduct@updateGambar');
  

  /*=================================Konfirmasi Pembayaran=================================*/
  /*Route::get('/konfirmasi', 'KonfirmasiController@index');
  // Detail Konfirmasi
  Route::get('/konfirmasi/detail/{id}', 'KonfirmasiController@detail');
  // Terima Konfirmasi
  Route::get('/konfirmasi/terima/{pesanan_id}', 'KonfirmasiController@terima');
  // Tolak Konfirmasi
  Route::get('/konfirmasi/tolak/{pesanan_id}', 'KonfirmasiController@tolak');*/

  /*================================End Konfirmasi Pembayaran==============================*/

  //=======================================List Pesanan====================================
  /*Route::get('/pesanan', 'Pesanan_controller@index');*/


});







Route::get('/user/show','UserController@showAll');
Route::get('/user/detail/{id}','UserController@detail');

Route::get('user/logout', 'UserController@logout');
  


Route::middleware('auth')->group(function(){

  Route::get('/user/transaksi-langsung/{id}','UserController@transaksiLangsung');

  // Checkout
  Route::get('/shopping-cart/checkout', 'CartController@checkout');

  // bayar
  Route::post('/shopping-cart/bayar', 'CartController@bayar');

  // Invoice
  Route::get('/invoice', 'InvoiceController@index');

  // List Invoice
  Route::get('/invoice/list', 'InvoiceController@list');

  // Detail Invoice
  Route::get('/invoice/detail/{id}', 'InvoiceController@detail');

  Route::get('/invoice/{id}', 'InvoiceController@delete');


  // Konfirmasi Pembayaran ==============================================
  Route::get('/konfirmasi', 'KonfirmasiController@index');
  Route::post('/konfirmasi/store', 'KonfirmasiController@store');

});

