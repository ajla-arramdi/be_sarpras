<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use PDF;

class LaporanPengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengembalian::with(['user', 'peminjaman.barang']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengembalians = $query->latest()->paginate(10);

        return view('laporan.pengembalian', compact('pengembalians'));
    }

    public function export(Request $request)
    {
        $query = Pengembalian::with(['user', 'peminjaman.barang']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengembalians = $query->latest()->get();

        $pdf = PDF::loadView('laporan.pengembalian-pdf', compact('pengembalians'));
        
        return $pdf->download('laporan-pengembalian.pdf');
    }
} 