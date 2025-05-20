<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // Tampilkan semua pengembalian yang pending
    public function index()
    {
        $pengembalians = Pengembalian::where('catatan', 'pending')->with(['user', 'peminjaman'])->get();
        return view('pengembalians.index', compact('pengembalians'));
    }

    // Menyetujui pengembalian (ubah catatan jadi completed)
    public function approve($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->catatan = 'completed';
        $pengembalian->denda = 0; // no denda kalau approved langsung
        $pengembalian->save();

        return redirect()->route('pengembalians.index')->with('success', 'Pengembalian disetujui.');
    }

    // Tandai pengembalian sebagai damage (terlambat, rusak, hilang), hitung denda sesuai kondisi
    public function markDamage(Request $request, $id)
    {
        $request->validate([
            'kondisi_barang' => 'required|in:terlambat,rusak,hilang',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->catatan = 'damage';
        $pengembalian->kondisi_barang = $request->kondisi_barang;

        // Logika denda sederhana, bisa disesuaikan:
        switch ($request->kondisi_barang) {
            case 'terlambat':
                $pengembalian->denda = 50000; // misal denda terlambat 50 ribu
                break;
            case 'rusak':
                $pengembalian->denda = 100000; // denda rusak 100 ribu
                break;
            case 'hilang':
                $pengembalian->denda = 200000; // denda hilang 200 ribu
                break;
            default:
                $pengembalian->denda = 0;
                break;
        }

        $pengembalian->save();

        return redirect()->route('pengembalians.index')->with('success', 'Status pengembalian diupdate dengan denda.');
    }
}
