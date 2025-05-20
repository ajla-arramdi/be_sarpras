<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\KategoriApiController;
use App\Http\Controllers\API\PeminjamanController;
use App\Http\Controllers\API\PengembalianApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
      // Route::get('/peminjaman/user', [PeminjamanController::class, 'userPeminjaman']);
    Route::get('/peminjaman/user', [PeminjamanController::class, 'getByUser']);
}); 

    
Route::get('/barangs', [BarangApiController::class, 'index']);




Route::prefix('pengembalians')->group(function () {
    Route::get('/', [PengembalianApiController::class, 'index']);
    Route::get('/{id}', [PengembalianApiController::class, 'show']);
    Route::post('/', [PengembalianApiController::class, 'store']);
    Route::post('/{id}/approve', [PengembalianApiController::class, 'approve']);
    Route::post('/{id}/damage', [PengembalianApiController::class, 'markDamage']);
});
