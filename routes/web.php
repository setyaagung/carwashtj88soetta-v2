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
    Route::get('/karyawan/{id}/create_absensi', 'KaryawanController@create_absensi')->name('create_absensi');
    Route::post('/karyawan/{id}/absensi/store_absensi', 'KaryawanController@store_absensi')->name('store_absensi');
    Route::get('/karyawan/{karyawan}/absensi/{id}/edit_absensi', 'KaryawanController@edit_absensi')->name('edit_absensi');
    Route::patch('/karyawan/{karyawan}/absensi/{id}', 'KaryawanController@update_absensi')->name('update_absensi');
    Route::delete('/karyawan/{karyawan}/absensi/{id}', 'KaryawanController@destroy_absensi')->name('destroy_absensi');
    Route::get('/karyawan/{id}/print_gaji/dari={dari}/sampai={sampai}', 'KaryawanController@print_gaji')->name('karyawan.print_gaji');
    //laporan pemasukkan
    Route::get('/laporan-pemasukkan/index', 'LaporanPemasukkanController@index')->name('laporan-pemasukkan.index');
    Route::get('/laporan-pemasukkan/filter', 'LaporanPemasukkanController@filter')->name('laporan-pemasukkan.filter');
    Route::get('/laporan-pemasukkan/print_pemasukkan/dari={dari}/sampai={sampai}/shift={shift}', 'LaporanPemasukkanController@print_pemasukkan')->name('laporan-pemasukkan.print_pemasukkan');
    //laporan pengeluaran
    Route::get('/laporan-pengeluaran/index', 'LaporanPengeluaranController@index')->name('laporan-pengeluaran.index');
    Route::get('/laporan-pengeluaran/filter', 'LaporanPengeluaranController@filter')->name('laporan-pengeluaran.filter');
    Route::get('/laporan-pengeluaran/print_pengeluaran/dari={dari}/sampai={sampai}/jenis={jenis}', 'LaporanPengeluaranController@print_pengeluaran')->name('laporan-pengeluaran.print_pengeluaran');
    //laporan pendapatan
    Route::get('/laporan-pendapatan/index', 'LaporanPendapatanController@index')->name('laporan-pendapatan.index');
    Route::get('/laporan-pendapatan/filter', 'LaporanPendapatanController@filter')->name('laporan-pendapatan.filter');
    Route::get('/laporan-pendapatan/print_pendapatan/dari={dari}/sampai={sampai}', 'LaporanPendapatanController@print_pendapatan')->name('laporan-pendapatan.print_pendapatan');
    //user
    Route::resource('user', 'UserController');
    Route::get('/update-status/{id}', 'UserController@update_status');
    Route::patch('/user/{id}/reset-password', 'UserController@reset_password')->name('user.reset-password');
});
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    //biodata
    Route::get('/biodata', 'BiodataController@index')->name('biodata');
    Route::patch('/biodata/update', 'BiodataController@update')->name('biodata.update');
    //info gaji
    Route::get('/informasi-gaji', 'GajiController@index')->name('informasi-gaji');
    Route::get('/informasi-gaji/filter', 'GajiController@filter')->name('informasi-gaji.filter');
});
