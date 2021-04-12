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
    Route::resource('paket', 'PaketController');
    Route::resource('rekap', 'RekapController');
    //cart rekap
    Route::post('/rekap/additem/{paket}', 'RekapController@addItem')->name('rekap.additem');
    Route::delete('/rekap/removeitem/{paket}', 'RekapController@removeItem')->name('rekap.removeitem');
    Route::post('/rekap/updatecart/{paket}', 'RekapController@updatecart')->name('rekap.updatecart');
    Route::post('/rekap/clear', 'RekapController@clear')->name('rekap.clear');
    Route::post('/rekap/verifikasi', 'RekapController@verifikasi')->name('rekap.verifikasi');
    //pengeluaran
    Route::resource('pengeluaran', 'PengeluaranController');
    Route::resource('karyawan', 'KaryawanController');
    Route::resource('user', 'UserController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
