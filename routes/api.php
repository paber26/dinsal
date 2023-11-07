<?php

use App\Http\Controllers\AdminThread;
use App\Http\Controllers\ArsipSoal;
use App\Http\Controllers\Forum;
use App\Http\Controllers\Kegiatan;
use App\Http\Controllers\KritikdanSaran;
use App\Http\Controllers\Materi;
use App\Http\Controllers\Profil;
use App\Http\Controllers\Proyek; 
use App\Http\Controllers\User;
use App\Http\Controllers\UserThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user/getproyek', [Proyek::class, 'getproyek']);
Route::get('user/getnamaproyek/{idp}', [Proyek::class, 'getnamaproyek']);

Route::get('user/getkegiatan/{idp}', [Kegiatan::class, 'getkegiatan']);
Route::get('user/getkegiatanfilter/{idp}/{status}', [Kegiatan::class, 'getkegiatanfilter']);
Route::get('user/kegiatan/kunjungi/{idk}', [Kegiatan::class, 'kunjungikegiatan']);
Route::post('user/kegiatan/pencarian', [Kegiatan::class, 'kegiatanpencarian']);

Route::post('user/kritikdansaran/kirim', [KritikdanSaran::class, 'kirim']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::get('admin/getproyek', [Proyek::class, 'getproyek']);
        Route::get('admin/getproyek/{idp}', [Proyek::class, 'getproyek']);
        Route::get('admin/getproyekfilter/{status}', [Proyek::class, 'getproyekfilter']);
        Route::post('admin/proyek/tambahkan'    , [Proyek::class, 'tambahkan']);
        Route::get('admin/proyek/hapus/{idp}', [Proyek::class, 'hapus']);
        Route::post('admin/proyek/edit', [Proyek::class, 'edit']);
        Route::get('admin/getdetailproyek/{idp}', [Proyek::class, 'getdetailproyek']);
        
        Route::get('admin/getuser', [User::class, 'getuser']);
        Route::get('admin/getuser/{id}', [User::class, 'getuser']);
        Route::get('admin/user/hapus/{username}', [User::class, 'hapus']);
        Route::post('admin/user/tambahkan', [User::class, 'tambahkan']);
        Route::post('admin/user/edit', [User::class, 'edit']);

        Route::get('admin/getkritikdansaran', [KritikdanSaran::class, 'getkritikdansaran']);

        Route::post('admin/kegiatan/tambahkan', [Kegiatan::class, 'tambahkan']);
        Route::post('admin/kegiatan/edit', [Kegiatan::class, 'edit']);
        Route::get('admin/getkegiatan/{idp}', [Kegiatan::class, 'getkegiatan']);
        Route::get('admin/getdetailkegiatan/{idk}', [Kegiatan::class, 'getdetailkegiatan']);
        Route::get('admin/getkegiatanfilter/{idp}/{status}', [Kegiatan::class, 'getkegiatanfilter']);
        Route::post('admin/kegiatan/pencarian', [Kegiatan::class, 'kegiatanpencarian']);
        Route::get('admin/kegiatan/hapus/{idk}', [Kegiatan::class, 'hapus']);
    }
);
