<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan semua data peminjaman (opsional)
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'barang'])->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    // Menyetujui peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'disetujui'; // atau 'approved'
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui.');
    }

    // Menolak peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak'; // atau 'rejected'
        $peminjaman->save();

        return redirect()->back()->with('error', 'Peminjaman ditolak.');
    }
}
