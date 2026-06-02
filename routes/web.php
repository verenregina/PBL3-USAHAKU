<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaDataController;
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

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | KELOLA DATA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/kelola-data', [KelolaDataController::class, 'index'])
        ->name('admin.kelola-data');


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

});