<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\TagihanController;
use App\Http\Controllers\API\getAllSekolah;
use App\Http\Controllers\API\checkTagihan;
use App\Http\Controllers\API\payTagihan;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sekolah', [getAllSekolah::class, 'index']);

Route::get('/tagihan/{idSekolah}/{nis}', [checkTagihan::class, 'index']);

Route::post('/tagihan', [payTagihan::class, 'index']);

