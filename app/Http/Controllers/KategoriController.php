<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }
    

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'description' => 'nullable|string',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Check if there are any active peminjaman for items in this category
        $hasActivePeminjaman = Peminjaman::whereHas('barang', function($query) use ($kategori) {
            $query->where('kategori_id', $kategori->id);
        })->whereIn('status', ['menunggu', 'disetujui'])->exists();

        if ($hasActivePeminjaman) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih ada barang yang sedang dipinjam.');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')
            ->with('success', 'Data kategori berhasil dihapus.');
    }

   
}
