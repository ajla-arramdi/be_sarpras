@extends('layouts.admin')

@section('title', 'Daftar Peminjaman')
@section('subtitle', 'Kelola data peminjaman barang')

@section('content')
<div class="space-y-6">

    {{-- Alerts --}}
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
                <i class="fas fa-exchange-alt text-2xl text-teal-700"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-teal-900 tracking-tight">Daftar Peminjaman</h2>
                <p class="text-sm text-teal-700">Total {{ $peminjamans->count() }} peminjaman</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow border border-teal-200">
        <table class="min-w-full text-gray-800 border-collapse">
            <thead class="bg-teal-50">
                <tr>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">ID</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Peminjam</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Barang</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Kelas</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Keterangan</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Jumlah</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tgl. Pinjam</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tgl. Kembali</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Status</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $peminjaman)
                <tr class="hover:bg-teal-100 transition">
                    <td class="px-6 py-4 border-b border-teal-200">#{{ $peminjaman->id }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user text-teal-500"></i>
                            <span>{{ $peminjaman->user->name ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $peminjaman->barang->nama_barang ?? 'Barang tidak tersedia' }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $peminjaman->kelas_peminjam }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $peminjaman->keterangan }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        <span class="px-3 py-1 text-sm rounded-full bg-teal-100 text-teal-800">
                            {{ $peminjaman->jumlah }}
                        </span>
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $peminjaman->tanggal_pinjam }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">{{ $peminjaman->tanggal_pengembalian }}</td>
                    <td class="px-6 py-4 border-b border-teal-200">
                        <span class="px-3 py-1 text-sm rounded-full
                            @if ($peminjaman->status === 'menunggu') bg-yellow-100 text-yellow-800
                            @elseif ($peminjaman->status === 'disetujui') bg-green-100 text-green-800
                            @elseif ($peminjaman->status === 'ditolak') bg-red-100 text-red-800
                            @elseif ($peminjaman->status === 'dikembalikan') bg-blue-100 text-blue-800
                            @endif">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 border-b border-teal-200 text-center whitespace-nowrap">
                        @if ($peminjaman->status === 'menunggu')
                        <div class="flex items-center justify-center space-x-2">
                            <form action="{{ route('peminjaman.approve', $peminjaman->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition font-semibold text-sm">
                                    <i class="fas fa-check mr-1"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition font-semibold text-sm">
                                    <i class="fas fa-times mr-1"></i> Tolak
                                </button>
                            </form>
                        </div>
                        @else
                        <span class="text-sm italic text-gray-500">Sudah {{ $peminjaman->status }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-exchange-alt text-4xl mb-2 text-gray-400"></i>
                            <p class="text-lg font-semibold">Belum ada data peminjaman</p>
                            <p class="text-sm">Silakan tambahkan data peminjaman terlebih dahulu</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
