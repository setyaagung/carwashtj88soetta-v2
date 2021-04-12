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
    return view('welcome');
});

//backend
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('kendaraan', 'KendaraanController');
    Route::resource('paket', 'PaketController');
    Route::resource('transaksi', 'TransaksiController');
    //cart transaksi
    Route::post('/transaksi/additem/{paket}', 'TransaksiController@addItem')->name('transaksi.additem');
    Route::delete('/transaksi/removeitem/{paket}', 'TransaksiController@removeItem')->name('transaksi.removeitem');
    Route::post('/transaksi/updatecart/{paket}', 'TransaksiController@updatecart')->name('transaksi.updatecart');
    Route::post('/transaksi/clear', 'TransaksiController@clear')->name('transaksi.clear');
    Route::post('/transaksi/pay', 'TransaksiController@pay')->name('transaksi.pay');
    //pengeluaran
    Route::resource('pengeluaran', 'PengeluaranController');
    Route::resource('karyawan', 'KaryawanController');
    Route::resource('user', 'UserController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
