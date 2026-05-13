
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN
Route::get('/admin', function () {

    // proteksi sederhana
    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    return view('admin.dashboard');

})->middleware('auth')->name('admin');

// KELOLA DATA
Route::get('/admin/kelola-data', function () {

    // proteksi sederhana
    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    return view('layouts.Kelola data');

})->middleware('auth')->name('admin.kelola-data');

// Routes untuk CRUD data usaha
Route::post('/admin/kelola-data', function () {
    // proteksi sederhana
    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    // TODO: Implementasi penyimpanan data
    return redirect()->route('admin.kelola-data')->with('success', 'Data berhasil ditambahkan');
})->middleware('auth')->name('kelola-data.store');

Route::put('/admin/kelola-data/{id}', function ($id) {
    // proteksi sederhana
    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    // TODO: Implementasi update data
    return redirect()->route('admin.kelola-data')->with('success', 'Data berhasil diupdate');
})->middleware('auth')->name('kelola-data.update');

Route::delete('/admin/kelola-data/{id}', function ($id) {
    // proteksi sederhana
    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    // TODO: Implementasi hapus data
    return redirect()->route('admin.kelola-data')->with('success', 'Data berhasil dihapus');
})->middleware('auth')->name('kelola-data.destroy');