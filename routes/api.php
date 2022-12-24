<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScanProdukController;

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

Route::get('/scan/{id}', [ScanProdukController::class, 'scan']);
Route::post('/verify', [ScanProdukController::class, 'verify']);
Route::post('/rating', [ScanProdukController::class, 'rating']);
Route::post('/report/{id}', [ScanProdukController::class, 'report']);
Route::post('/coba', function () {
    return response()->json('oke', 200);
});
