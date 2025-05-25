<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengembalianController;

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




Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});



// Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');



Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

  // Menampilkan semua peminjaman untuk admin
  Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

  // Admin menyetujui peminjaman
  Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');

  // Admin menolak peminjaman
  Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

  



    Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('pengembalian/{id}/approve', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
    Route::post('pengembalian/{id}/reject', [PengembalianController::class, 'reject'])->name('pengembalian.reject');
Route::get('pengembalian/{id}/denda', [PengembalianController::class, 'markDamaged'])->name('pengembalian.denda');
Route::put('pengembalian/{id}/denda', [PengembalianController::class, 'updateDamaged'])->name('pengembalian.updateDamaged');

});







Route::get('/', function () {
    return view('welcome');
});
