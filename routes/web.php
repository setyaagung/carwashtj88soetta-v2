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
    Route::get('/rekap/print/{id}', 'RekapController@print_rekap')->name('rekap.print');
    //pengeluaran
    Route::resource('pengeluaran', 'PengeluaranController');
    //karyawan
    Route::resource('karyawan', 'KaryawanController');
    Route::get('/karyawan/{id}/filter', 'KaryawanController@filter')->name('karyawan.filter');
    //laporan pemasukkan
    Route::get('/laporan-pemasukkan/index', 'LaporanPemasukkanController@index')->name('laporan-pemasukkan.index');
    Route::get('/laporan-pemasukkan/filter', 'LaporanPemasukkanController@filter')->name('laporan-pemasukkan.filter');
    Route::resource('user', 'UserController');
    Route::get('/update-status/{id}', 'UserController@update_status');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
