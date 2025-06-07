@extends('layouts.admin')

@section('title', 'Laporan Peminjaman')
@section('subtitle', 'Laporan data peminjaman barang')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8 border-b border-teal-300 pb-4">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-file-alt text-2xl text-teal-700"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-teal-900 tracking-tight">Laporan Peminjaman</h2>
            </div>
        </div>
        <a href="{{ route('laporan.peminjaman.export', request()->query()) }}"
           class="inline-flex items-center px-5 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <i class="fas fa-file-download mr-2"></i> Export PDF
        </a>
    </div>

    {{-- Filter + Search --}}
    <div class="bg-white rounded-2xl shadow border border-teal-200 p-6 space-y-4">
        <form action="{{ route('laporan.peminjaman') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama Peminjam / Barang</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                       placeholder="Contoh: Andi atau Laptop">
            </div>

            {{-- Filter Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>

            {{-- Button --}}
            <div class="md:col-span-3 flex justify-end pt-2">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-teal-600 to-teal-700 text-white font-medium hover:from-teal-700 hover:to-teal-800 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow border border-teal-200">
        <table class="min-w-full text-gray-800 border-collapse">
            <thead class="bg-teal-50">
                <tr>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">ID</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Peminjam</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Barang</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Jumlah</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tgl. Pinjam</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tgl. Kembali</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $peminjaman)
                    <tr class="hover:bg-teal-50 transition">
                        <td class="px-6 py-4 border-b border-teal-200">#{{ $peminjaman->id }}</td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            <div class="text-sm font-medium text-gray-900">{{ $peminjaman->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $peminjaman->kelas_peminjam }}</div>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            <div class="text-sm font-medium text-gray-900">{{ $peminjaman->barang->nama_barang }}</div>
                            <div class="text-sm text-gray-500">{{ $peminjaman->barang->code }}</div>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200 text-center">
                            <span class="px-3 py-1 text-sm rounded-full bg-teal-100 text-teal-800">
                                {{ $peminjaman->jumlah }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200 text-sm text-gray-600">
                            {{ $peminjaman->tanggal_pinjam }}
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200 text-sm text-gray-600">
                            {{ $peminjaman->tanggal_pengembalian }}
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            <span class="px-3 py-1 text-sm rounded-full
                                @if ($peminjaman->status === 'menunggu') bg-yellow-100 text-yellow-800
                                @elseif ($peminjaman->status === 'disetujui') bg-green-100 text-green-800
                                @elseif ($peminjaman->status === 'ditolak') bg-red-100 text-red-800
                                @elseif ($peminjaman->status === 'dikembalikan') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-semibold">Tidak ada data peminjaman</p>
                                <p class="text-sm">Silakan ubah filter atau cari dengan kata kunci berbeda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
