<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

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
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', function () {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        return view('admin.dashboard');

    })->name('admin');

    /*
    |--------------------------------------------------------------------------
    | KELOLA DATA
    |--------------------------------------------------------------------------
    */

    // READ
    Route::get('/admin/kelola-data', function () {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $dataUsaha = [

            [
                'id' => 'USH-001',
                'nama_usaha' => 'Warung Makan Bu Sari',
                'kategori' => 'Kuliner',
                'kota' => 'Surabaya',
                'modal_awal' => 5000000,
                'status' => 'aktif',
                'potensi' => 'Tinggi',
            ],

            [
                'id' => 'USH-002',
                'nama_usaha' => 'Toko Fashion Indah',
                'kategori' => 'Fashion',
                'kota' => 'Malang',
                'modal_awal' => 15000000,
                'status' => 'aktif',
                'potensi' => 'Sedang',
            ],

            [
                'id' => 'USH-003',
                'nama_usaha' => 'CV Teknologi Maju',
                'kategori' => 'Teknologi',
                'kota' => 'Sidoarjo',
                'modal_awal' => 50000000,
                'status' => 'nonaktif',
                'potensi' => 'Tinggi',
            ],

            [
                'id' => 'USH-004',
                'nama_usaha' => 'Klinik Sehat Bersama',
                'kategori' => 'Kesehatan',
                'kota' => 'Gresik',
                'modal_awal' => 30000000,
                'status' => 'aktif',
                'potensi' => 'Tinggi',
            ],

            [
                'id' => 'USH-005',
                'nama_usaha' => 'Bimbel Pintar Ceria',
                'kategori' => 'Pendidikan',
                'kota' => 'Mojokerto',
                'modal_awal' => 10000000,
                'status' => 'aktif',
                'potensi' => 'Rendah',
            ],

        ];

        return view('admin.kelola-data', compact('dataUsaha'));

    })->name('admin.kelola-data');

    // CREATE
    Route::post('/admin/kelola-data', function () {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data berhasil ditambahkan');

    })->name('kelola-data.store');

    // UPDATE
    Route::put('/admin/kelola-data/{id}', function ($id) {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data berhasil diupdate');

    })->name('kelola-data.update');

    // DELETE
    Route::delete('/admin/kelola-data/{id}', function ($id) {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data berhasil dihapus');

    })->name('kelola-data.destroy');

    /*
    |--------------------------------------------------------------------------
    | DATASET
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dataset', function () {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        return view('admin.dataset');

    })->name('admin.dataset');

});