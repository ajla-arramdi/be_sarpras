<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'code' => 'required|string|unique:barangs,code',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'kategori_id' => $request->kategori_id,
            'code' => $request->code,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'code' => 'required|string|unique:barangs,code,' . $id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $barang = Barang::findOrFail($id);
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $barang->foto = $fotoPath;
        }
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'kategori_id' => $request->kategori_id,
            'code' => $request->code,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
