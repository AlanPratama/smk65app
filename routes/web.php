<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruViewController;
use App\Http\Controllers\LaporanSiswaController;
use App\Http\Controllers\PengumumanAjaxController;
use App\Http\Controllers\SiswaViewController;
use App\Models\Pengumuman;
use App\Models\TipePengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // dd(Auth::guard('guru')->user());
    return view('pages.homepage');
})->name('login');

// PENGUMUMAN

Route::controller(PengumumanAjaxController::class)->group(function () {
    Route::get('/pengumumanAjax', 'indexAjax');
    Route::get('/pengumuman/{id}', 'show');
    Route::post('/pengumuman', 'store');
    Route::put('/pengumuman/{id}', 'update');
    Route::delete('/pengumuman/{id}', 'destroy');


    Route::get('/tipe-pengumumanAjax', 'indexTipeAjax');
    Route::get('/tipe-pengumuman/{id}', 'showTipe');
    Route::post('/tipe-pengumuman', 'storeTipe');
    Route::put('/tipe-pengumuman/{id}', 'updateTipe');
    Route::delete('/tipe-pengumuman/{id}', 'destroyTipe');
});


Route::prefix('/auth')->group(function () {
    Route::get('/siswa', [AuthController::class, 'loginSiswa']);
    Route::post('/siswa', [AuthController::class, 'loginSiswaProcess'])->name('loginSiswaProcess');

    Route::get('/guru', [AuthController::class, 'loginGuru']);
    Route::post('/guru', [AuthController::class, 'loginGuruProcess'])->name('loginGuruProcess');
});


Route::middleware('authSuccess')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA 
    // ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA  
    Route::prefix('/siswa')->middleware('onlySiswa')->group(function () {
        Route::get('/beranda', [SiswaViewController::class, 'beranda']);
        
        Route::get('/pengumuman', [SiswaViewController::class, 'pengumuman']);
        Route::get('/laporan-siswa', [SiswaViewController::class, 'laporanSiswa']);

        // LAPORAN SISWA
        Route::get('/laporan-siswa-ajax', [LaporanSiswaController::class, 'index']);
        Route::get('/laporan-siswa-ajax/{id}', [LaporanSiswaController::class, 'show']);
        Route::post('/laporan-siswa-ajax', [LaporanSiswaController::class, 'store']);
        Route::put('/laporan-siswa-ajax/{id}', [LaporanSiswaController::class, 'update']);
        
    });
    // ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA  
    // ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA || ROUTE SISWA  


    // ====================================================================================== 


    // ROUTE GURU || ROUTE GURU || ROUTE GURU || ROUTE GURU || ROUTE GURU || ROUTE GURU 
    // ROUTE GURU || ROUTE GURU || ROUTE GURU || ROUTE GURU || ROUTE GURU || ROUTE GURU  
    Route::prefix('/guru')->middleware('onlyGuru')->group(function () {
        Route::get('/dashboard', [GuruViewController::class, 'dashboard']);

        Route::get('/pengumuman', [GuruViewController::class, 'pengumuman']);
        Route::get('/laporan-siswa', [GuruViewController::class, 'laporanSiswa']);
    });
});
