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
Route::post('/', 'LandingController@saveContact');
Route::get('/berita/{id}', 'LandingController@berita');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin'], 'prefix'=> 'admin'], function() {
    Route::get('/dashboard', 'Admin\AdminController@home')->name('admin.dashboard');
    Route::get('/dashboard/stat', 'Admin\AdminController@get_data')->name('search');
    // Route::get('/dashboard/', 'Admin\AdminController@search')->name('search');
    
    
    Route::group(['prefix' => '/pengguna'],function(){
        Route::group(['prefix' => '/user-admin'],function(){
            Route::get('/', 'Admin\PenggunaAdminController@index');
            Route::post('/import','Admin\PenggunaAdminController@csv_import')->name('import.pengguna.admin');
            Route::post('/', 'Admin\PenggunaAdminController@store')->name('store.pengguna.admin');
            Route::post('/reset', 'Admin\PenggunaAdminController@reset')->name('reset.admin');
            Route::delete('/delete/{id}', 'Admin\PenggunaAdminController@delete');
        });

        Route::group(['prefix' => '/user-mahasiswa'],function(){
            Route::get('/', 'Admin\PenggunaMahasiswaController@index');
            Route::post('/import','Admin\PenggunaMahasiswaController@csv_import')->name('import.pengguna.mhs');
            Route::post('/', 'Admin\PenggunaMahasiswaController@store')->name('store.pengguna.mhs');
            Route::post('/reset', 'Admin\PenggunaMahasiswaController@reset')->name('reset.mahasiswa');
            Route::delete('/delete/{id}', 'Admin\PenggunaMahasiswaController@delete');
        });

    });

    Route::group(['prefix' => '/master'],function(){
        Route::group(['prefix' => '/user'],function(){
            Route::get('/', 'Admin\DataUserController@index');
            Route::post('/import','Admin\DataUserController@csv_import')->name('import');
            Route::get('/edit/{id}', 'Admin\DataUserController@edituser');
            Route::put('/update/{id}', 'Admin\DataUserController@updateuser');
            Route::delete('/delete/{id}', 'Admin\DataUserController@delete');
            Route::post('/', 'Admin\DataUserController@store')->name('store.user');
        });

        //master dosen
        Route::group(['prefix' => '/dosen'],function(){
            Route::get('/', 'Admin\DataDosenController@index');
            Route::post('/', 'Admin\DataDosenController@store')->name('store.dosen');
            Route::get('/edit/{id}', 'Admin\DataDosenController@edit');
            Route::put('/update/{id}', 'Admin\DataDosenController@update');
            Route::delete('/delete/{id}', 'Admin\DataDosenController@delete');
            Route::post('/import','Admin\DataDosenController@csv_import')->name('import.dosen');
        });

        //master matkul
        Route::group(['prefix' => '/matkul'],function(){
            Route::get('/', 'Admin\DataMatkulController@index');
            Route::get('/edit/{id}', 'Admin\DataMatkulController@edit');
            Route::put('/update/{id}', 'Admin\DataMatkulController@update');
            Route::post('/', 'Admin\DataMatkulController@store')->name('store.matkul');
            Route::delete('/delete/{id}', 'Admin\DataMatkulController@delete');
            Route::post('/import','Admin\DataMatkulController@csv_import')->name('import.matkul');
        });

        //master ruangan
        Route::group(['prefix' => '/ruangan'],function(){
            Route::get('/', 'Admin\DataRuanganController@index');
            Route::get('/edit/{id}', 'Admin\DataRuanganController@edit');
            Route::put('/update/{id}', 'Admin\DataRuanganController@update');
            Route::post('/', 'Admin\DataRuanganController@store')->name('store.ruangan');
            Route::delete('/delete/{id}', 'Admin\DataRuanganController@delete');
            Route::post('/import','Admin\DataRuanganController@csv_import')->name('import.ruangan');
        });

        //master jadwal
        Route::group(['prefix' => '/jadwal'],function(){
            Route::get('/', 'Admin\DataJadwalController@index');
            Route::get('/edit/{id}', 'Admin\DataJadwalController@edit');
            Route::put('/update/{id}', 'Admin\DataJadwalController@update');
            Route::post('/', 'Admin\DataJadwalController@store')->name('store.jadwal');
            Route::delete('/delete/{id}', 'Admin\DataJadwalController@delete');
            Route::post('/import','Admin\DataJadwalController@csv_import')->name('import.jadwal');
        });

        //master kelas
        Route::group(['prefix' => '/kelas'],function(){
            Route::get('/', 'Admin\DataKelasController@index');
            Route::get('/edit/{id}', 'Admin\DataKelasController@edit');
            Route::put('/update/{id}', 'Admin\DataKelasController@update');
            Route::post('/', 'Admin\DataKelasController@store')->name('store.kelas');
            Route::delete('/delete/{id}', 'Admin\DataKelasController@delete');
            Route::post('/import','Admin\DataKelasController@csv_import')->name('import.kelas');
        });

        //master semester
        Route::group(['prefix' => '/semester'],function(){
            Route::get('/', 'Admin\DataSemesterController@index');
            Route::get('/edit/{id}', 'Admin\DataSemesterController@edit');
            Route::put('/update/{id}', 'Admin\DataSemesterController@update');
            Route::post('/', 'Admin\DataSemesterController@store')->name('store.semester');
            Route::delete('/delete/{id}', 'Admin\DataSemesterController@delete');
            Route::post('/import','Admin\DataSemesterController@csv_import')->name('import.semester');
        });
    });
    //praktikum
    Route::group(['prefix' => '/praktikum'],function(){
        Route::get('/', 'Admin\DataPraktikumController@index');
        Route::get('/edit/{id}', 'Admin\DataPraktikumController@edit');
            Route::put('/update/{id}', 'Admin\DataPraktikumController@update');
            Route::post('/', 'Admin\DataPraktikumController@store')->name('store.praktikum');
            Route::delete('/delete/{id}', 'Admin\DataPraktikumController@delete');
    });
    //periode
    Route::group(['prefix' => '/periode'],function(){
        Route::get('/', 'Admin\DataPeriodeController@index');
        Route::get('/edit/{id}', 'Admin\DataPeriodeController@edit');
        Route::put('/update/{id}', 'Admin\DataPeriodeController@update');
        Route::post('/', 'Admin\DataPeriodeController@store')->name('store.periode');
        Route::delete('/delete/{id}', 'Admin\DataPeriodeController@delete');
    });

    //ketentuan
    Route::group(['prefix' => '/ketentuan'],function(){
        Route::get('/', 'Admin\DataKetentuanController@index');
        Route::get('/edit/{id}', 'Admin\DataKetentuanController@edit');
        Route::put('/update/{id}', 'Admin\DataKetentuanController@update');
        Route::post('/', 'Admin\DataKetentuanController@store')->name('store.ketentuan');
        Route::delete('/delete/{id}', 'Admin\DataKetentuanController@delete');
    });

    //berita
    Route::group(['prefix' => '/berita'],function(){
        Route::get('/', 'Admin\DataBeritaController@index');
        Route::post('/', 'Admin\DataBeritaController@store')->name('store.berita');
        Route::get('/edit/{id}', 'Admin\DataBeritaController@edit');
        Route::put('/update/{id}', 'Admin\DataBeritaController@update');
        Route::delete('/delete/{id}', 'Admin\DataBeritaController@delete');
    });

    //ubah-password
    Route::group(['prefix' => 'ubah-password'],function(){
        Route::get('/', 'Admin\UbahPasswordController@index');
        Route::put('/', 'Admin\UbahPasswordController@changePassword')->name('changePasswordAdmin');
    });

    //profil
    Route::group(['prefix' => 'profil'],function(){
        Route::get('/', 'Admin\ProfilController@index');
        Route::get('/edit-foto/{id}', 'Admin\ProfilController@editFoto');
        Route::put('/update-foto/{id}', 'Admin\ProfilController@updateFoto');
        Route::get('/edit-data/{id}', 'Admin\ProfilController@editData');
        Route::put('/update-data/{id}', 'Admin\ProfilController@updateData');        
    });

    //pengajuan
    Route::group(['prefix' => 'pengajuan'],function(){
        Route::get('/', 'Admin\PengajuanController@index');
        Route::get('/{id}', ['as' => 'pengajuans.status', 'uses' => 'Admin\PengajuanController@editStat']);
        Route::post('/update', ['as' => 'pengajuans.change', 'uses' => 'Admin\PengajuanController@statusUpdate']);
    });
});

Route::group(['middleware' => ['auth', 'mahasiswa'], 'prefix'=> 'mahasiswa'], function() {
    Route::get('/dashboard', 'Mahasiswa\MahasiswaController@index')->name('mahasiswa.beranda');
    //profil
    Route::group(['prefix' => 'profil'],function(){
        Route::get('/', 'Mahasiswa\ProfilController@index');
        Route::get('/edit-foto/{id}', 'Mahasiswa\ProfilController@editFoto');
        Route::put('/update-foto/{id}', 'Mahasiswa\ProfilController@updateFoto');
        Route::get('/edit-data/{id}', 'Mahasiswa\ProfilController@editData');
        Route::put('/update-data/{id}', 'Mahasiswa\ProfilController@updateData');
        Route::get('/edit-bank/{id}', 'Mahasiswa\ProfilController@editBank');
        Route::put('/update-bank/{id}', 'Mahasiswa\ProfilController@updateBank');
        Route::get('/edit-mahasiswa/{id}', 'Mahasiswa\ProfilController@editMahasiswa');
        Route::put('/update-mahasiswa/{id}', 'Mahasiswa\ProfilController@updateMahasiswa');
    });

    //ubah-password
    Route::group(['prefix' => 'ubah-password'],function(){
        Route::get('/', 'Mahasiswa\UbahPasswordController@index');
        Route::put('/', 'Mahasiswa\UbahPasswordController@changePassword')->name('changePassword');
    });

    //daftar
    Route::group(['prefix' => 'daftar'],function(){
        Route::get('/', 'Mahasiswa\DaftarController@index');
        Route::post('/', 'Mahasiswa\DaftarController@store')->name('store.daftar');
        Route::delete('/delete/{id}', 'Mahasiswa\DaftarController@delete');
    });

    //pengumuman
    Route::group(['prefix' => 'pengumuman'],function(){
        Route::get('/', 'Mahasiswa\PengumumanController@index');
    });
});

