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


Route::prefix('data')->middleware(['has_fill_data'])->group(function () {
	Route::get('/fill-data', 'PageController@getDataFillingPage');
	Route::post('/fill-data', 'MahasiswaController@setDataFilling')->name('fill.data');
});


Route::prefix('mahasiswa')->middleware(['mahasiswa_only'])->group(function () {
	Route::get('/', 'PageController@getMahasiswaPage');
	Route::get('/history', 'PageController@getHistoryPage');
});


Route::prefix('dosen')->middleware(['dosen_only'])->group(function () {
	Route::get('/', 'PageController@getDosenPage');
	Route::get('/tambah-ujian', 'PageController@getTambahUjianPage');
	Route::post('/tambah-ujian', 'DosenController@setTambahUjian')->name('tambah.ujian');
	Route::post('/add/ujian/peserta', 'DosenController@setTambahPeserta')->name('tambah.peserta');
	Route::post('/delete/ujian/peserta', 'DosenController@deletePeserta')->name('hapus.peserta');
	Route::post('/delete/ujian/soal', 'DosenController@deleteSoal')->name('hapus.soal');

	Route::get('/list-ujian', 'PageController@getListUjianPage');
	Route::get('/list/ujian/data', 'PageController@getListUjianData');
	Route::get('/list/ujian/data/{id}', 'PageController@getUjianData');
	Route::post('/update-ujian', 'DosenController@setUpdateUjian')->name('update.ujian');

	Route::get('/ujian/peserta/{id}', 'PageController@getPesertaUjianPage');
	Route::get('/ujian/soal/{id}', 'PageController@getSoalUjianPage');
	// Route::get('/list/ujian/peserta/{id}', 'DosenController@getPesertaUjian');
});

Route::prefix('admin')->middleware(['admin_only'])->group(function () {

});

Route::post('/finish-tour', 'PageController@finishTour');

Route::get('/home', 'HomeController@index')->name('home');
