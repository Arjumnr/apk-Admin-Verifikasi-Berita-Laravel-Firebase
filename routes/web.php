<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CekFaktaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\tesController;

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



Route::get('/',[DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/tes',[tesController::class, 'tes'])->name('tes');

Route::get('/login',[LoginController::class, 'indexLogin'])->name('indexLogin');
Route::post('/loginSS',[LoginController::class, 'buatSession'])->name('buatSession');
Route::get('/logout',[DashboardController::class, 'logout'])->name('logout');

    
//berita
Route::group(['prefix' => '/berita'], function(){
    Route::get('/',[BeritaController::class, 'indexBerita'])->name('indexberita');
    Route::post('/tambahBerita',[BeritaController::class, 'tambahBerita'])->name('tambahBerita');
    Route::get('/deleteBerita/{id}',[BeritaController::class, 'deleteBerita'])->name('deleteBerita');
});

//laporan
Route::group(['prefix' => '/laporan'], function(){
    Route::get('/',[LaporanController::class, 'indexLaporan'])->name('indexLaporan');
    Route::put('/cekLaporan/{id}',[LaporanController::class, 'cekLaporan'])->name('cekLaporan');
});

//cek fakta
Route::group(['prefix' => '/cekFakta'], function(){
    Route::get('/',[CekFaktaController::class, 'indexCekFakta'])->name('indexCekFakta');
    Route::put('/cekFakta/{id}',[CekFaktaController::class, 'cekFakta'])->name('cekFakta');

});

