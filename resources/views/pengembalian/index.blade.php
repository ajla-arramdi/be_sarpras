@extends('layouts.admin')

@section('title', 'Daftar Pengembalian')
@section('subtitle', 'Kelola data pengembalian barang')

@section('content')
<div class="space-y-6">

    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
            </div>
            <div>
                <p class="font-medium">Berhasil!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8 border-b border-teal-300 pb-4">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-undo text-2xl text-teal-700"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-teal-900 tracking-tight">Daftar Pengembalian</h2>
                <p class="text-sm text-teal-700">Total {{ $pengembalians->count() }} pengembalian</p>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow border border-teal-200">
        <table class="min-w-full text-gray-800 border-collapse">
            <thead class="bg-teal-50">
                <tr>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">ID</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Peminjam</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tgl. Pinjam</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tgl. Kembali</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Jumlah</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Kondisi</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Denda</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Status</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $pengembalian)
                <tr class="hover:bg-teal-100 transition">
                    <td class="px-6 py-4 border-b border-teal-200">#{{ $pengembalian->id }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user text-teal-500"></i>
                            <span>{{ $pengembalian->user->name ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $pengembalian->peminjaman->tanggal_pinjam }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $pengembalian->tanggal_dikembalikan }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        <span class="px-3 py-1 text-sm rounded-full bg-teal-100 text-teal-800">
                            {{ $pengembalian->jumlah }}
                        </span>
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200 capitalize">{{ $pengembalian->kondisi_barang }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        Rp{{ number_format($pengembalian->total_denda, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        <span class="px-3 py-1 text-sm rounded-full
                            @if ($pengembalian->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif ($pengembalian->status === 'complete') bg-green-100 text-green-800
                            @elseif ($pengembalian->status === 'damage') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($pengembalian->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200 text-center whitespace-nowrap">
                        @if ($pengembalian->status === 'pending')
                        <div class="flex items-center justify-center space-x-2">
                            <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition font-semibold text-sm">
                                    <i class="fas fa-check mr-1"></i> Approve
                                </button>
                            </form>
                            <a href="{{ route('pengembalian.denda', $pengembalian->id) }}" class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition font-semibold text-sm">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Tandai Rusak
                            </a>
                        </div>
                        @else
                        <span class="text-sm italic text-gray-500">Sudah {{ $pengembalian->status }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-undo text-4xl mb-2 text-gray-400"></i>
                            <p class="text-lg font-semibold">Belum ada data pengembalian</p>
                            <p class="text-sm">Silakan tunggu pengembalian dari peminjam</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
