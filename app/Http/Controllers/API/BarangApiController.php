<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class BarangApiController extends Controller
{
    public function index()
    {
        // Ambil semua barang beserta relasi kategori
        $barangs = Barang::with('kategori')->get();

        // Format data
        $formatted = $barangs->map(function ($barang) {
            return [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'jumlah' => $barang->jumlah,
                'code' => $barang->code,
                'foto' => $barang->foto ? url('storage/' . $barang->foto) : null,
                'kategori_id' => $barang->kategori_id,
                'kategori' => $barang->kategori ? [
                    'id' => $barang->kategori->id,
                    'nama_kategori' => $barang->kategori->nama,
                ] : null
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formatted
        ]);
    }
}
