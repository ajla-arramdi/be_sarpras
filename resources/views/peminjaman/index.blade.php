@extends('layouts.admin')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">📘 Daftar Peminjaman</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-blue-100">
            <thead class="bg-blue-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Id</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Nama Peminjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Barang</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Kelas</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Keterangan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Jumlah</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Tanggal Pinjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Tanggal Kembali</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($peminjamans as $peminjaman)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->id}}</td>
                         <td class="px-4 py-3 text-gray-800">{{ $peminjaman->user->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->barang->nama_barang ?? 'Barang tidak tersedia' }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->kelas_peminjam }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->keterangan }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->jumlah }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->tanggal_pinjam }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $peminjaman->tanggal_pengembalian }}</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full
                                @if ($peminjaman->status === 'menunggu') bg-yellow-100 text-yellow-800
                                @elseif ($peminjaman->status === 'disetujui') bg-green-100 text-green-800
                                @elseif ($peminjaman->status === 'ditolak') bg-red-100 text-red-800
                                @elseif ($peminjaman->status === 'dikembalikan') bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if ($peminjaman->status === 'menunggu')
                                <div class="flex space-x-2">
                                    <form action="{{ route('peminjaman.approve', $peminjaman->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded shadow">
                                            ✅ Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded shadow">
                                            ❌ Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-500 italic text-xs">Sudah {{ $peminjaman->status }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
