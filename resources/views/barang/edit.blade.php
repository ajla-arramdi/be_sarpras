@extends('layouts.admin')

@section('title', 'Edit Barang')
@section('subtitle', 'Ubah informasi barang yang ada')

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Barang -->
            <div class="space-y-2">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">
                    Nama Barang
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-box text-lg"></i>
                    </span>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="Masukkan nama barang" />
                </div>
            </div>

            <!-- Kode Barang -->
            <div class="space-y-2">
                <label for="code" class="block text-sm font-medium text-gray-700">
                    Kode Barang
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-barcode text-lg"></i>
                    </span>
                    <input type="text" id="code" name="code" value="{{ old('code', $barang->code) }}" required
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="Masukkan kode barang" />
                </div>
            </div>

            <!-- Jumlah -->
            <div class="space-y-2">
                <label for="jumlah" class="block text-sm font-medium text-gray-700">
                    Jumlah
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-cubes text-lg"></i>
                    </span>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" required min="0"
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="Masukkan jumlah barang" />
                </div>
            </div>

            <!-- Kategori -->
            <div class="space-y-2">
                <label for="kategori_id" class="block text-sm font-medium text-gray-700">
                    Kategori
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-tags text-lg"></i>
                    </span>
                    <select id="kategori_id" name="kategori_id" required
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Foto -->
            <div class="space-y-2">
                <label for="foto" class="block text-sm font-medium text-gray-700">
                    Foto Barang
                </label>
                @if ($barang->foto)
                    <div class="mb-4">
                        <div class="relative w-32 h-32 rounded-lg overflow-hidden shadow-md">
                            <img src="{{ asset('storage/' . $barang->foto) }}" 
                                alt="Foto Barang" 
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                <span class="text-white text-sm">Foto Saat Ini</span>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-camera text-lg"></i>
                    </span>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors bg-white" />
                </div>
                <p class="text-sm text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6">
                <a href="{{ route('barang.index') }}" 
                    class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 rounded-lg bg-gradient-to-r from-red-600 to-red-700 text-white font-medium hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>
                    Update Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
