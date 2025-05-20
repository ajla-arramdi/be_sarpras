<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianApiController extends Controller
{
    // Tampilkan semua pengembalian dengan filter optional status
    public function index(Request $request)
    {
        $status = $request->query('status'); // optional: pending, completed, damage
        $query = Pengembalian::query();

        if ($status && in_array($status, ['pending', 'completed', 'damage'])) {
            $query->where('catatan', $status);
        }

        $pengembalians = $query->with(['user', 'peminjaman'])->get();

        return response()->json($pengembalians);
    }

    // Tampilkan detail pengembalian
    public function show($id)
    {
        $pengembalian = Pengembalian::with(['user', 'peminjaman'])->find($id);

        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian tidak ditemukan'], 404);
        }

        return response()->json($pengembalian);
    }

    // Simpan pengembalian baru (create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'peminjaman_id' => 'required|exists:peminjamen,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_dikembalikan' => 'required|date',
            'kondisi_barang' => 'required|in:baik,terlambat,rusak,hilang',
            'denda' => 'nullable|integer|min:0',
            'catatan' => 'nullable|in:pending,completed,damage',
        ]);

        // Default catatan pending jika tidak diisi
        if (!isset($validated['catatan'])) {
            $validated['catatan'] = 'pending';
        }

        // Jika kondisi selain baik, set catatan damage dan set denda default jika denda kosong
        if (in_array($validated['kondisi_barang'], ['terlambat', 'rusak', 'hilang'])) {
            $validated['catatan'] = 'damage';

            if (!isset($validated['denda']) || $validated['denda'] === null) {
                switch ($validated['kondisi_barang']) {
                    case 'terlambat':
                        $validated['denda'] = 50000;
                        break;
                    case 'rusak':
                        $validated['denda'] = 100000;
                        break;
                    case 'hilang':
                        $validated['denda'] = 200000;
                        break;
                }
            }
        } else {
            // Kondisi baik = catatan completed dan denda 0
            $validated['catatan'] = 'completed';
            $validated['denda'] = 0;
        }

        $pengembalian = Pengembalian::create($validated);

        return response()->json([
            'message' => 'Pengembalian berhasil disimpan',
            'data' => $pengembalian,
        ], 201);
    }

    // Approve pengembalian (ubah catatan jadi completed dan denda 0)
    public function approve($id)
    {
        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian tidak ditemukan'], 404);
        }

        $pengembalian->catatan = 'completed';
        $pengembalian->denda = 0;
        $pengembalian->save();

        return response()->json([
            'message' => 'Pengembalian disetujui',
            'data' => $pengembalian,
        ]);
    }

    // Tandai damage dan hitung denda
    public function markDamage(Request $request, $id)
    {
        $validated = $request->validate([
            'kondisi_barang' => 'required|in:terlambat,rusak,hilang',
        ]);

        $pengembalian = Pengembalian::find($id);
        if (!$pengembalian) {
            return response()->json(['message' => 'Pengembalian tidak ditemukan'], 404);
        }

        $pengembalian->catatan = 'damage';
        $pengembalian->kondisi_barang = $validated['kondisi_barang'];

        switch ($validated['kondisi_barang']) {
            case 'terlambat':
                $pengembalian->denda = 50000;
                break;
            case 'rusak':
                $pengembalian->denda = 100000;
                break;
            case 'hilang':
                $pengembalian->denda = 200000;
                break;
        }

        $pengembalian->save();

        return response()->json([
            'message' => 'Pengembalian diupdate dengan status damage',
            'data' => $pengembalian,
        ]);
    }
}
