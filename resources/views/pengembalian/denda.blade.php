@extends('layouts.admin')

@section('title', 'Update Denda Pengembalian Rusak')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-red-600 mb-6">⚠️ Update Denda Pengembalian Rusak</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6">
            <p><strong>Nama User:</strong> {{ $pengembalian->user->name ?? '-' }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d/m/Y') }}</p>
            <p><strong>Tanggal Dikembalikan:</strong> {{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d/m/Y') }}</p>
            <p><strong>Jumlah:</strong> {{ $pengembalian->jumlah }}</p>
            <p><strong>Kondisi Barang:</strong> <span class="capitalize">{{ $pengembalian->kondisi_barang }}</span></p>
            <p><strong>Status Saat Ini:</strong> <span class="uppercase font-semibold text-red-600">{{ $pengembalian->status }}</span></p>
        </div>

        <form action="{{ route('pengembalian.updateDamaged', $pengembalian->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="denda" class="block text-sm font-medium text-gray-700 mb-1">Denda (Rp)</label>
            <input 
                type="number" 
                name="denda" 
                id="denda" 
                min="0" 
                value="{{ old('denda', $pengembalian->denda ?? 0) }}" 
                required 
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                placeholder="Masukkan jumlah denda"
            >

            <button type="submit" 
                class="mt-6 w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded shadow">
                Simpan Denda & Tandai Rusak
            </button>
        </form>

        <a href="{{ route('pengembalian.index') }}" 
           class="mt-4 inline-block text-sm text-gray-600 hover:text-gray-900 underline">
            ← Kembali ke Daftar Pengembalian
        </a>
    </div>
</div>
@endsection
