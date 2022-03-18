<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MitraController;

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

Route::get('/', function () {
     if (Auth::check()) {
          // return redirect('dashboard');
          return redirect('sekolah');
     }else{
          return redirect('login');
     }
});

/**
 * For disable register user
 */
Route::get('/register', function () {
     if (Auth::check()) {
          // return redirect('dashboard');
          return redirect('sekolah');
     }else{
          return redirect('login');
     }
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
     
     Route::get('sekolah', SekolahController::index())->name('sekolah');
     // Route::get('sekolah', [SekolahController::class, 'index'])->name('sekolah');

     Route::get('siswa', [SiswaController::class, 'index'])->name('siswa');

     Route::get('tahunajaran', [TahunAjaranController::class, 'index'])->name('tahunajaran');
     
     Route::get('mitra', [MitraController::class, 'index'])->name('mitra');

     Route::get('/dashboard', function () {
         return view('dashboard');
     })->name('dashboard');
 });