@extends('layouts.admin')

@section('title', 'Update Denda Pengembalian')
@section('subtitle', 'Update denda untuk pengembalian barang')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-money-bill text-2xl text-red-600"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Update Denda Pengembalian</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <div>
                    <p class="font-bold">Terjadi kesalahan</p>
                    <ul class="list-disc list-inside text-sm mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Content Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <!-- Info Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Peminjam</label>
                    <p class="mt-1 text-lg font-medium text-gray-900">{{ $pengembalian->user->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal Pinjam</label>
                    <p class="mt-1 text-lg font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal Dikembalikan</label>
                    <p class="mt-1 text-lg font-medium text-gray-900">{{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Jumlah</label>
                    <p class="mt-1 text-lg font-medium text-gray-900">{{ $pengembalian->jumlah }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Kondisi Barang</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800 capitalize">
                            {{ $pengembalian->kondisi_barang }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Status</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800 uppercase font-semibold">
                            {{ $pengembalian->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <form action="{{ route('pengembalian.updateDamaged', $pengembalian->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="denda" class="block text-sm font-medium text-gray-700 mb-2">Denda (Rp)</label>
                <div class="relative rounded-lg shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">Rp</span>
                    </div>
                    <input 
                        type="number" 
                        name="denda" 
                        id="denda" 
                        min="0" 
                        value="{{ old('denda', $pengembalian->denda ?? 0) }}" 
                        required 
                        class="pl-12 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        placeholder="Masukkan jumlah denda"
                    >
                </div>
            </div>

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('pengembalian.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 text-white font-medium hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Denda & Tandai Rusak
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
