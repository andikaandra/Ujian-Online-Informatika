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

Route::get('register', 'Auth\RegisterController@registerPage');
Route::post('register', 'Auth\RegisterController@register');
Route::get('login', 'Auth\LoginController@loginPage');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LogoutController@logout');


Route::prefix('tcexam')->group(function () {

	Route::prefix('mahasiswa')->middleware(['mahasiswa_only'])->group(function () {
		Route::get('/', 'PageController@getMahasiswaPage');
		Route::get('/history', 'PageController@getHistoryPage');

		Route::get('/exam/{id}/{name}', 'PageController@getUjianPage')->name('change.question');
		Route::get('/exam/{id}/u/{flag}', 'PageController@getUjianPageDummy');

		Route::post('/exam/join', 'MahasiswaController@ujian')->name('join.ujian');

		//ujian
		Route::post('/exam/jawab/ragu-ragu', 'PageController@raguRagu')->name('ragu.ragu');
		Route::post('/exam/jawab/yakin', 'PageController@yakinJawab')->name('yakin.yakin');
		Route::post('/exam/jawab/soal', 'PageController@jawabSoal')->name('jawab.soal');
		Route::post('/exam/reset/soal', 'PageController@resetSoal')->name('reset.soal');
		Route::post('/exam/finish/test', 'MahasiswaController@finishTest')->name('finish.test');
		// Route::post('/change/question', 'PageController@changeQuestion')->name('change.question');
	});


	Route::prefix('dosen')->middleware(['dosen_only'])->group(function () {
		Route::get('/', 'PageController@getDosenPage');
		
		Route::get('/tambah-ujian', 'PageController@getTambahUjianPage');
		Route::post('/tambah-ujian', 'DosenController@setTambahUjian')->name('tambah.ujian');

		Route::post('/add/ujian/peserta', 'DosenController@setTambahPeserta')->name('tambah.peserta');
		Route::post('/delete/ujian/peserta', 'DosenController@deletePeserta')->name('hapus.peserta');

		Route::post('/lanjutkan/ujian', 'DosenController@lanjutkanUjian')->name('lanjutkan.ujian');

        Route::post('/add/ujian/soal', 'DosenController@setTambahSoal')->name('tambah.soal');
        Route::post('/edit/ujian/soal', 'DosenController@setEditSoal')->name('edit.soal');
		Route::post('/delete/ujian/soal', 'DosenController@deleteSoal')->name('hapus.soal');

		Route::get('/list-ujian', 'PageController@getListUjianPage');
		Route::get('/list/ujian/data', 'PageController@getListUjianData');
		Route::get('/list/ujian/data/{id}', 'PageController@getUjianData');
		Route::get('/list/soal/data/{id}', 'PageController@getSoalData');

		Route::post('/update-ujian', 'DosenController@setUpdateUjian')->name('update.ujian');

		Route::get('/ujian/peserta/{id}', 'PageController@getPesertaUjianPage');
		Route::get('/ujian/soal/{id}', 'PageController@getSoalUjianPage');

		Route::post('/import/soal', 'DosenController@importSoal')->name('import.soal');

		Route::get('/check/exam/{id}/{kode}', 'PageController@getUjianDoneQuestion');
		Route::get('/export/{id}', 'PageController@exportNilai');
		// Route::get('/list/ujian/peserta/{id}', 'DosenController@getPesertaUjian');
	});

	Route::post('/finish-tour', 'PageController@finishTour');

	Route::get('/home', 'HomeController@index')->name('home');

});