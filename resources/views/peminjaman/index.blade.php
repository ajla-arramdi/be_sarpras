@extends('layouts.admin')

@section('title', 'Daftar Peminjaman')
@section('subtitle', 'Kelola data peminjaman barang')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-3">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
            <i class="fas fa-exchange-alt text-2xl text-red-600"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Peminjaman</h2>
            <p class="text-sm text-gray-600">Total {{ $peminjamans->count() }} peminjaman</p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Peminjam
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Barang
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Pinjam
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Kembali
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($peminjamans as $peminjaman)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                #{{ $peminjaman->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-red-600"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $peminjaman->user->name ?? '-' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-box text-red-600"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $peminjaman->barang->nama_barang ?? 'Barang tidak tersedia' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $peminjaman->kelas_peminjam }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $peminjaman->keterangan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                    {{ $peminjaman->jumlah }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $peminjaman->tanggal_pinjam }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $peminjaman->tanggal_pengembalian }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-sm rounded-full
                                    @if ($peminjaman->status === 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif ($peminjaman->status === 'disetujui') bg-green-100 text-green-800
                                    @elseif ($peminjaman->status === 'ditolak') bg-red-100 text-red-800
                                    @elseif ($peminjaman->status === 'dikembalikan') bg-blue-100 text-blue-800
                                    @endif">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if ($peminjaman->status === 'menunggu')
                                    <div class="flex items-center space-x-3">
                                        <form action="{{ route('peminjaman.approve', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-green-600 hover:text-green-700 hover:bg-green-50 transition-colors duration-200">
                                                <i class="fas fa-check mr-1.5"></i>
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors duration-200">
                                                <i class="fas fa-times mr-1.5"></i>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic text-sm">Sudah {{ $peminjaman->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <i class="fas fa-exchange-alt text-4xl mb-3"></i>
                                    <p class="text-lg font-medium">Belum ada data peminjaman</p>
                                    <p class="text-sm">Silakan tambahkan peminjaman baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
