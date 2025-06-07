@extends('layouts.admin')

@section('title', 'Laporan Pengembalian')
@section('subtitle', 'Laporan data pengembalian barang')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8 border-b border-teal-300 pb-4">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-file-alt text-2xl text-teal-700"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-teal-900 tracking-tight">Laporan Pengembalian</h2>
            </div>
        </div>
        <a href="{{ route('laporan.pengembalian.export', request()->query()) }}"
           class="inline-flex items-center px-5 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <i class="fas fa-file-download mr-2"></i> Export PDF
        </a>
    </div>

    {{-- Filter + Search --}}
    <div class="bg-white rounded-2xl shadow border border-teal-200 p-6 space-y-4">
        <form action="{{ route('laporan.pengembalian') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Filter Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="damage" {{ request('status') == 'damage' ? 'selected' : '' }}>Damage</option>
                </select>
            </div>

            {{-- Search Barang / Nama Pengembali --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama Pengembali / Barang</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                       placeholder="Contoh: Budi atau Proyektor">
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
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Pengembali</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Barang</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Jumlah</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Tanggal Kembali</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Kondisi</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Denda</th>
                    <th class="px-6 py-4 border-b border-teal-300 text-sm font-semibold text-teal-700">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengembalians as $pengembalian)
                    <tr class="hover:bg-teal-50 transition">
                        <td class="px-6 py-4 border-b border-teal-200 text-sm">#{{ $pengembalian->id }}</td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            <div class="text-sm font-medium text-gray-900">{{ $pengembalian->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            <div class="text-sm font-medium text-gray-900">{{ $pengembalian->peminjaman->barang->nama_barang }}</div>
                            <div class="text-sm text-gray-500">{{ $pengembalian->peminjaman->barang->code }}</div>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200 text-center">
                            <span class="px-3 py-1 text-sm rounded-full bg-teal-100 text-teal-800">
                                {{ $pengembalian->jumlah }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200 text-sm text-gray-600">
                            {{ $pengembalian->tanggal_dikembalikan }}
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            @php
                                $kondisiColors = [
                                    'baik' => 'bg-green-100 text-green-800',
                                    'terlambat' => 'bg-yellow-100 text-yellow-800',
                                    'rusak' => 'bg-red-100 text-red-800',
                                    'hilang' => 'bg-red-100 text-red-800'
                                ];
                                $kondisiColor = $kondisiColors[$pengembalian->kondisi_barang] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 text-sm rounded-full {{ $kondisiColor }}">
                                {{ ucfirst($pengembalian->kondisi_barang) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200 text-sm text-gray-600">
                            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 border-b border-teal-200">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'damage' => 'bg-red-100 text-red-800'
                                ];
                                $statusColor = $statusColors[$pengembalian->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 text-sm rounded-full {{ $statusColor }}">
                                {{ ucfirst($pengembalian->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-box-open text-4xl mb-3 text-teal-300"></i>
                                <p class="text-lg font-semibold">Tidak ada data pengembalian</p>
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
