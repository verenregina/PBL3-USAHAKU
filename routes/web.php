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

})->middleware('auth');

// RECOMMENDATION
Route::get('/recommendation', [\App\Http\Controllers\RecommendationController::class, 'showForm'])->name('recommendation.form')->middleware('auth');
Route::post('/recommendation', [\App\Http\Controllers\RecommendationController::class, 'processRecommendation'])->name('recommendation.process')->middleware('auth');

// REKOMENDASI INDONESIA
Route::get('/rekomendasi', [\App\Http\Controllers\RecommendationController::class, 'showForm'])->name('rekomendasi.form')->middleware('auth');
Route::post('/rekomendasi', [\App\Http\Controllers\RecommendationController::class, 'processRecommendation'])->name('rekomendasi.process')->middleware('auth');

Route::view('/hasil-rekomendasi', 'pages.hasil-rekomendasi')->name('hasil.rekomendasi')->middleware('auth');