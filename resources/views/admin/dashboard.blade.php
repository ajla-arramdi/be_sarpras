@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Admin</h1>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition-all border-l-4 border-blue-500">
            <div class="flex items-center space-x-4">
                <div class="text-blue-500 text-3xl"><i class="fas fa-folder"></i></div>
                <div>
                    <p class="text-sm text-gray-600">Total Kategori</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalKategori }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition-all border-l-4 border-green-500">
            <div class="flex items-center space-x-4">
                <div class="text-green-500 text-3xl"><i class="fas fa-box"></i></div>
                <div>
                    <p class="text-sm text-gray-600">Total Barang</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalBarang }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition-all border-l-4 border-yellow-500">
            <div class="flex items-center space-x-4">
                <div class="text-yellow-500 text-3xl"><i class="fas fa-hand-holding"></i></div>
                <div>
                    <p class="text-sm text-gray-600">Total Peminjaman</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPeminjaman }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition-all border-l-4 border-red-500">
            <div class="flex items-center space-x-4">
                <div class="text-red-500 text-3xl"><i class="fas fa-undo"></i></div>
                <div>
                    <p class="text-sm text-gray-600">Total Pengembalian</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPengembalian }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Kategori Terbaru --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Kategori Terbaru</h2>
        <div class="bg-white p-4 rounded-xl shadow">
            <ul class="list-disc list-inside space-y-1 text-gray-700">
                @forelse ($recentKategori as $kategori)
                    <li>{{ $kategori->nama_kategori ?? 'Kategori kosong' }}</li>
                @empty
                    <li class="text-gray-400 italic">Tidak ada data kategori.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Barang Terbaru --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Barang Terbaru</h2>
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Barang</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kategori</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($recentBarang as $barang)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $barang->nama_barang ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $barang->stok ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-gray-400 italic">Tidak ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Peminjaman Terbaru --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Peminjaman Terbaru</h2>
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">User</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Barang</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Pinjam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($recentPeminjaman as $peminjaman)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $peminjaman->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $peminjaman->barang->nama_barang ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $peminjaman->tanggal_pinjam ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $peminjaman->status ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-gray-400 italic">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pengembalian Terbaru --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Pengembalian Terbaru</h2>
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">User</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Barang</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Kembali</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($recentPengembalian as $pengembalian)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $pengembalian->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $pengembalian->peminjaman->barang->nama_barang ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $pengembalian->tanggal_kembali ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $pengembalian->status ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-gray-400 italic">Tidak ada data pengembalian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
