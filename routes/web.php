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

Route::get('/', 'LandingController@index')->name('index');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'checkRole:admin']], function() {
    Route::get('/dashboard', 'Admin\AdminController@home')->name('admin.dashboard');
    Route::prefix('/master')->group(function(){
        Route::prefix('/user')->group(function(){
        // Route::resource('/','Admin\DataUserController');
        // Route::post('/', 'Admin\DataUserController@store');
            Route::get('/', 'Admin\DataUserController@index');
            Route::post('/import','Admin\DataUserController@csv_import')->name('import');
            Route::get('/edit/{id}', 'Admin\DataUserController@edituser');
            Route::put('/update/{id}', 'Admin\DataUserController@updateuser');
            Route::delete('/delete/{id}', 'Admin\DataUserController@delete');
            Route::post('/', 'Admin\DataUserController@store')->name('store.user');
        // Route::get('/show/{id}', 'Admin\DataUserController@show');
        // Route::put('/', 'Admin\DataUserController@update')->name('update.user');
        });

        //master dosen
        Route::prefix('/dosen')->group(function(){
            Route::get('/', 'Admin\DataDosenController@index');
            Route::post('/', 'Admin\DataDosenController@store')->name('store.dosen');
            Route::get('/edit/{id}', 'Admin\DataDosenController@edit');
            Route::put('/update/{id}', 'Admin\DataDosenController@update');
            Route::delete('/delete/{id}', 'Admin\DataDosenController@delete');
            Route::post('/import','Admin\DataDosenController@csv_import')->name('import.dosen');
        });

        //master matkul
        Route::prefix('/matkul')->group(function(){
            Route::get('/', 'Admin\DataMatkulController@index');
            Route::get('/edit/{id}', 'Admin\DataMatkulController@edit');
            Route::put('/update/{id}', 'Admin\DataMatkulController@update');
            Route::post('/', 'Admin\DataMatkulController@store')->name('store.matkul');
            Route::delete('/delete/{id}', 'Admin\DataMatkulController@delete');
            Route::post('/import','Admin\DataMatkulController@csv_import')->name('import.matkul');
        });

        //master ruangan
        Route::prefix('/ruangan')->group(function(){
            Route::get('/', 'Admin\DataRuanganController@index');
            Route::get('/edit/{id}', 'Admin\DataRuanganController@edit');
            Route::put('/update/{id}', 'Admin\DataRuanganController@update');
            Route::post('/', 'Admin\DataRuanganController@store')->name('store.ruangan');
            Route::delete('/delete/{id}', 'Admin\DataRuanganController@delete');
            Route::post('/import','Admin\DataRuanganController@csv_import')->name('import.ruangan');
        });

        //master jadwal
        Route::prefix('/jadwal')->group(function(){
            Route::get('/', 'Admin\DataJadwalController@index');
            Route::get('/edit/{id}', 'Admin\DataJadwalController@edit');
            Route::put('/update/{id}', 'Admin\DataJadwalController@update');
            Route::post('/', 'Admin\DataJadwalController@store')->name('store.jadwal');
            Route::delete('/delete/{id}', 'Admin\DataJadwalController@delete');
            Route::post('/import','Admin\DataJadwalController@csv_import')->name('import.jadwal');
        });

        //master kelas
        Route::prefix('kelas')->group(function(){
            Route::get('/', 'Admin\DataKelasController@index');
            Route::get('/edit/{id}', 'Admin\DataKelasController@edit');
            Route::put('/update/{id}', 'Admin\DataKelasController@update');
            Route::post('/', 'Admin\DataKelasController@store')->name('store.kelas');
            Route::delete('/delete/{id}', 'Admin\DataKelasController@delete');
            Route::post('/import','Admin\DataKelasController@csv_import')->name('import.kelas');
        });

        //master ketentuan
        Route::prefix('ketentuan')->group(function(){
            Route::get('/', 'Admin\DataKetentuanController@index');
            Route::get('/edit/{id}', 'Admin\DataKetentuanController@edit');
            Route::put('/update/{id}', 'Admin\DataKetentuanController@update');
            Route::post('/', 'Admin\DataKetentuanController@store')->name('store.ketentuan');
            Route::delete('/delete/{id}', 'Admin\DataKetentuanController@delete');
            Route::post('/import','Admin\DataKetentuanController@csv_import')->name('import.ketentuan');
        });
    });
});

Route::group(['middleware' => ['auth', 'checkRole:mahasiswa']], function() {
    Route::get('/beranda', 'Mahasiswa\MahasiswaController@index')->name('mahasiswa.beranda');
});

