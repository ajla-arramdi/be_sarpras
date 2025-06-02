<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use PDF;

class LaporanPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'barang']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->paginate(10);

        return view('laporan.peminjaman', compact('peminjamans'));
    }

    public function export(Request $request)
    {
        $query = Peminjaman::with(['user', 'barang']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->get();

        $pdf = PDF::loadView('laporan.peminjaman-pdf', compact('peminjamans'));
        
        return $pdf->download('laporan-peminjaman.pdf');
    }
} 