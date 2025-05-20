<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;

class PeminjamanController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
            // 'nama_peminjam' => 'required|string|max:255',
            'kelas_peminjam' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);
        $validated['status'] = 'menunggu';
        $barang = Barang::findOrFail($validated['barang_id']);

        // Cek stok barang
        if ($barang->jumlah < $validated['jumlah']) {
            return response()->json([
                'message' => 'Stok barang tidak mencukupi',
            ], 400);
        }

        // Kurangi stok barang
        $barang->jumlah -= $validated['jumlah'];
        $barang->save();

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create($validated);
        $peminjaman->load(['barang', 'user']);

        return response()->json([
            'message' => 'Peminjaman berhasil ditambahkan',
            'data' => [
                'id' => $peminjaman->id,
                // 'nama_peminjam' => $peminjaman->nama_peminjam,
                'kelas_peminjam' => $peminjaman->kelas_peminjam,
                'keterangan' => $peminjaman->keterangan,
                'jumlah' => $peminjaman->jumlah,
                'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
                'tanggal_pengembalian' => $peminjaman->tanggal_pengembalian,
                'status' => $peminjaman->status,
                'barang' => [
                    'id' => $peminjaman->barang->id,
                    'nama' => $peminjaman->barang->nama
                ]
            ]
        ], 201);
    }

public function getByUser(Request $request)
{
    $user = $request->user();
    $peminjamans = Peminjaman::with('barang')
        ->where('user_id', $user->id)
        ->get();

    return response()->json([
        'success' => true,
        'data' => $peminjamans,
    ]);
}



   public function index()
    {
        $peminjamans = Peminjaman::with(['barang'])->get();
        return response()->json([
            'success' => true,
            'data' => $peminjamans
        ]);
    }
}

