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

Route::get('login', 'Auth\LoginController@loginPage');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LogoutController@logout');

Route::get('/data/fill-data', 'PageController@getDataFillingPage');
Route::post('/data/fill-data', 'MahasiswaController@setDataFilling')->name('fill.data');


Route::get('/mahasiswa', 'PageController@getMahasiswaPage');

Route::get('/dosen', 'PageController@getDosenPage');
Route::get('/dosen/tambah-ujian', 'PageController@getTambahUjianPage');
Route::post('/dosen/tambah-ujian', 'MahasiswaController@setTambahUjian')->name('tambah.ujian');
Route::get('/dosen/list-ujian', 'PageController@getListUjianPage');


Route::get('/home', 'HomeController@index')->name('home');
