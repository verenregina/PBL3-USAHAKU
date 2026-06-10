<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaDataController;
use App\Http\Controllers\JenisUsahaController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\BobotSawController;
use App\Http\Controllers\RuleForwardController;
use App\Models\JenisUsaha;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// FORM REKOMENDASI
Route::get('/rekomendasi-form', [RekomendasiController::class, 'showForm'])
    ->name('rekomendasi-form');
Route::post('/rekomendasi/proses', [RekomendasiController::class, 'processRecommendation'])
    ->name('rekomendasi.proses');
Route::get('/rekomendasi/hasil/{id}', [RekomendasiController::class, 'hasil'])
    ->name('rekomendasi.hasil');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Jenis Usaha
Route::get('/jenis-usaha', [JenisUsahaController::class, 'index']);
Route::get('/jenis-usaha/{id}', [JenisUsahaController::class, 'show']);

// Wilayah
Route::get('/wilayah/kabupaten', [WilayahController::class, 'kabupaten']);
// Route::get('/wilayah/kecamatan/{id}', [WilayahController::class, 'kecamatan']);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/history', [DashboardController::class, 'history'])->name('admin.history');
    Route::get('/admin/riwayat-pengguna', [DashboardController::class, 'userHistory'])->name('admin.riwayat-pengguna');

    /*
    |--------------------------------------------------------------------------
    | KELOLA DATA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/kelola-data', [KelolaDataController::class, 'index'])
        ->name('admin.kelola-data');

    Route::get('/admin/kelola-data/search', [KelolaDataController::class, 'search'])
        ->name('kelola-data.search');

    Route::get('/admin/kelola-data/{id}', [KelolaDataController::class, 'show'])
        ->name('kelola-data.show');

   /*
|--------------------------------------------------------------------------
| CRUD DATA
|--------------------------------------------------------------------------
*/

Route::post('/admin/kelola-data', [KelolaDataController::class, 'store'])
    ->name('kelola-data.store');

Route::put('/admin/kelola-data/{id}', [KelolaDataController::class, 'update'])
    ->name('kelola-data.update');

Route::delete('/admin/kelola-data/{id}', [KelolaDataController::class, 'destroy'])
    ->name('kelola-data.destroy');


/*
|--------------------------------------------------------------------------
| KELOLA BOBOT SAW
|--------------------------------------------------------------------------
*/

Route::get('/admin/bobot-saw', [BobotSawController::class, 'index'])
    ->name('admin.bobot.index');

Route::post('/admin/bobot-saw', [BobotSawController::class, 'update'])
    ->name('admin.bobot.update');

/*
|--------------------------------------------------------------------------
| KELOLA RULE FORWARD CHAINING
|--------------------------------------------------------------------------
*/

Route::get('/admin/rule-forward', [RuleForwardController::class, 'index'])
    ->name('admin.rule.index');

Route::post('/admin/rule-forward', [RuleForwardController::class, 'store'])
    ->name('admin.rule.store');

Route::put('/admin/rule-forward/{id}', [RuleForwardController::class, 'update'])
    ->name('admin.rule.update');

Route::delete('/admin/rule-forward/{id}', [RuleForwardController::class, 'destroy'])
    ->name('admin.rule.destroy');

});