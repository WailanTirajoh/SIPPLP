<?php

use App\Http\Controllers\ArsipPertandinganController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\AtletFisikController;
use App\Http\Controllers\AtletPplpController;
use App\Http\Controllers\AtletPrestasiController;
use App\Http\Controllers\AtletSekolahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaborController;
use App\Http\Controllers\CaborPertandinganController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\PertandinganController;
use App\Http\Controllers\PrestasiAtletController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth', 'checkRole:Super']], function () {
    Route::resource('user', UserController::class);
    Route::get('user/{user}/editPassword', [UserController::class, 'editPassword'])->name('user.editPassword');
    Route::put('user/{user}/updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');
});
Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    Route::resource('atlet', AtletController::class);
    Route::resource('pelatih', PelatihController::class);
    Route::resource('cabor', CaborController::class);
    Route::resource('sekolah', SekolahController::class);
    Route::resource('pertandingan', PertandinganController::class);
    Route::resource('prestasi', PrestasiController::class);
    Route::resource('sertifikasi', SertifikasiController::class);

    Route::get('/cabor/{cabor}/pertandingan/create', [CaborPertandinganController::class, 'create'])->name('cabor.pertandingan.create');
    Route::post('/cabor/{cabor}/pertandingan/store', [CaborPertandinganController::class, 'store'])->name('cabor.pertandingan.store');

    Route::get('/atlet/{atlet}/fisik/create',[AtletFisikController::class, 'create'])->name('atlet.fisik.create');
    Route::post('/atlet/{atlet}/fisik/store',[AtletFisikController::class, 'store'])->name('atlet.fisik.store');
    Route::delete('/atlet/{atlet}/fisik/{fisik}', [AtletFisikController::class, 'destroy'])->name('atlet.fisik.destroy');
    Route::get('/atlet/{atlet}/fisik/{fisik}/edit', [AtletFisikController::class, 'edit'])->name('atlet.fisik.edit');
    Route::post('/atlet/{atlet}/fisik/{fisik}/update',[AtletFisikController::class, 'update'])->name('atlet.fisik.update');

    Route::get('/atlet/{atlet}/pplp/create',[AtletPplpController::class, 'create'])->name('atlet.pplp.create');
    Route::post('/atlet/{atlet}/pplp/store',[AtletPplpController::class, 'store'])->name('atlet.pplp.store');
    Route::delete('/atlet/{atlet}/pplp/{pplp}', [AtletPplpController::class, 'destroy'])->name('atlet.pplp.destroy');
    Route::get('/atlet/{atlet}/pplp/{pplp}/edit', [AtletPplpController::class, 'edit'])->name('atlet.pplp.edit');
    Route::post('/atlet/{atlet}/pplp/{pplp}/update',[AtletPplpController::class, 'update'])->name('atlet.pplp.update');

    Route::get('/atlet/{atlet}/sekolah/create',[AtletSekolahController::class, 'create'])->name('atlet.sekolah.create');
    Route::post('/atlet/{atlet}/sekolah/store',[AtletSekolahController::class, 'store'])->name('atlet.sekolah.store');
    Route::delete('/atlet/{atlet}/sekolah/{sekolah}', [AtletSekolahController::class, 'destroy'])->name('atlet.sekolah.destroy');
    Route::get('/atlet/{atlet}/sekolah/{sekolah}/edit', [AtletSekolahController::class, 'edit'])->name('atlet.sekolah.edit');
    Route::post('/atlet/{atlet}/sekolah/{sekolah}/update',[AtletSekolahController::class, 'update'])->name('atlet.sekolah.update');

    Route::get('/atlet/{atlet}/prestasi/create',[AtletPrestasiController::class, 'create'])->name('atlet.prestasi.create');
    Route::post('/atlet/{atlet}/prestasi/store',[AtletPrestasiController::class, 'store'])->name('atlet.prestasi.store');
    Route::delete('/atlet/{atlet}/prestasi/{prestasi}', [AtletPrestasiController::class, 'destroy'])->name('atlet.prestasi.destroy');
    Route::get('/atlet/{atlet}/prestasi/{prestasi}/edit', [AtletPrestasiController::class, 'edit'])->name('atlet.prestasi.edit');
    Route::post('/atlet/{atlet}/prestasi/{prestasi}/update',[AtletPrestasiController::class, 'update'])->name('atlet.prestasi.update');

    Route::get('/prestasi/{prestasi}/atlet/create', [PrestasiAtletController::class, 'create'])->name('prestasi.atlet.create');
    Route::post('/prestasi/{prestasi}/atlet/store', [PrestasiAtletController::class, 'store'])->name('prestasi.atlet.store');

    Route::get('pertandingan/{pertandingan}/arsip/create', [ArsipPertandinganController::class, 'create'])->name('arsippertandingan.create');
    Route::post('pertandingan/{pertandingan}/arsip/store', [ArsipPertandinganController::class, 'store'])->name('arsippertandingan.store');

    Route::get('total-atlet-cabor', [ChartController::class, 'getTotalAtletPerCabor']);

    Route::get('chart/{index}', [ChartController::class, 'getCabor']);

    Route::get('pertandingan/detail/{cabor}/{bulan}', [ChartController::class, 'pertandingan']);
    Route::get('pertandingan-per-bulan/{cabor}', [ChartController::class, 'getPertandinganPerBulan']);
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Pelatih']], function () {

});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Atlet']], function () {

});
Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Pelatih,Atlet']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('/activity',[UserController::class,'activity'])->name('user.activity');
    Route::get('/setting',[UserController::class,'setting'])->name('user.setting');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin']);
