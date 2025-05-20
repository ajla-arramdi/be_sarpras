<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // Tampilkan semua pengembalian yang pending
    public function index()
{
    $pengembalians = Pengembalian::with(['peminjaman', 'user'])->latest()->get(); // atau sesuaikan dengan relasi
    return view('pengembalian.index', compact('pengembalians'));
}

    // Menyetujui pengembalian (ubah catatan jadi completed)
    public function approve($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->status === 'complete') {
            return redirect()->route('admin.pengembalian.index')->with('error', 'Pengembalian ini sudah diselesaikan.');
        }

        // Hitung keterlambatan dan denda
        $pengembalian->hitungKeterlambatan();
        
        $pengembalian->update(['status' => 'complete']);

        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status' => 'returned']);

        // Kembalikan stok barang
        $barang = $peminjaman->barang;
        if ($barang) {
            $barang->increment('jumlah', $pengembalian->jumlah_dikembalikan);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil disetujui.');
    }


    public function reject($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $pengembalian->update(['status' => 'damage']);

        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status' => 'rejected']);

        $barang = $peminjaman->barang;
        if ($barang) {
            $barang->decrement('stok', $pengembalian->jumlah_dikembalikan);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian barang rusak berhasil ditandai.');
    }
    // Tandai pengembalian sebagai damage (terlambat, rusak, hilang), hitung denda sesuai kondisi
    public function markDamaged($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('admin.pengembalian.markDamaged', compact('pengembalian'));
    }

    public function updateDamaged(Request $request, $id)
    {
        $validated = $request->validate([
            'denda' => 'required|numeric|min:0',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);

        $pengembalian->update([
            'status' => 'damage',
            'denda' => $validated['denda'],
        ]);

        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status' => 'rejected']);

        $barang = $peminjaman->barang;
        if ($barang) {
            $barang->increment('jumlah', $pengembalian->jumlah_dikembalikan);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Denda pengembalian rusak berhasil diperbarui.');
    }

}
