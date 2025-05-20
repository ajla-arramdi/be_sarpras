@extends('layouts.admin')

@section('title', 'Edit Barang')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_barang" class="block text-gray-700 font-medium">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-blue-500 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-medium">Kode Barang</label>
            <input type="text" name="code" id="code" value="{{ old('code', $barang->code) }}"
                class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-blue-500 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700 font-medium">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $barang->jumlah) }}"
                class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-blue-500 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="kategori_id" class="block text-gray-700 font-medium">Kategori</label>
            <select name="kategori_id" id="kategori_id"
                class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-blue-500 focus:outline-none" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-gray-700 font-medium">Foto</label>
            @if ($barang->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang Baru" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <input type="file" name="foto" id="foto" accept="image/*"
                class="w-full mt-1 px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500">
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('barang.index') }}" class="text-sm text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
