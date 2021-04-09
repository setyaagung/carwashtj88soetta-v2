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
    Route::resource('karyawan', 'KaryawanController');
    Route::resource('user', 'UserController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
