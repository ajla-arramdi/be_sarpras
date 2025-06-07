<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
  public function index()
{
    $totalKategori = Kategori::count();
    $totalBarang = Barang::count();
    $totalPeminjaman = Peminjaman::count();
    $totalPengembalian = Pengembalian::count();

    $recentKategori = Kategori::latest()->limit(5)->get();
    $recentBarang = Barang::with('kategori')->latest()->limit(5)->get();
    $recentPeminjaman = Peminjaman::with(['user', 'barang'])->latest()->limit(5)->get();
    $recentPengembalian = Pengembalian::with(['user', 'peminjaman.barang'])->latest()->limit(5)->get();

    return view('admin.dashboard', compact(
        'totalKategori',
        'totalBarang',
        'totalPeminjaman',
        'totalPengembalian',
        'recentKategori',
        'recentBarang',
        'recentPeminjaman',
        'recentPengembalian'
    ));
}
}