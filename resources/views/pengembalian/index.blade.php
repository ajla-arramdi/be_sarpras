@extends('layouts.admin')

@section('title', 'Daftar Pengembalian')
@section('subtitle', 'Kelola data pengembalian barang')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-3">
        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fas fa-undo text-2xl text-white"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Pengembalian</h2>
            <p class="text-sm text-gray-600">Total {{ $pengembalians->count() }} pengembalian</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Peminjam
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Pinjam
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Kembali
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kondisi
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Denda
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengembalians as $pengembalian)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                #{{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center text-white">
                                        <i class="fas fa-user text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $pengembalian->user->name ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 text-sm rounded-full bg-gradient-to-r from-red-100 to-red-50 text-red-800 border border-red-200">
                                    {{ $pengembalian->jumlah }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800 capitalize">
                                    {{ $pengembalian->kondisi_barang }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                                Rp{{ number_format($pengembalian->total_denda, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 text-sm rounded-full
                                    @if ($pengembalian->status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800 border border-yellow-200
                                    @elseif ($pengembalian->status === 'complete') bg-gradient-to-r from-green-100 to-green-50 text-green-800 border border-green-200
                                    @elseif ($pengembalian->status === 'damage') bg-gradient-to-r from-red-100 to-red-50 text-red-800 border border-red-200
                                    @else bg-gradient-to-r from-gray-100 to-gray-50 text-gray-800 border border-gray-200
                                    @endif">
                                    {{ ucfirst($pengembalian->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($pengembalian->status === 'pending')
                                    <div class="flex flex-col gap-2 max-w-[120px] mx-auto">
                                        <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST" onsubmit="return confirm('Setujui pengembalian ini?')">
                                            @csrf
                                            <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-3 py-1.5 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-lg shadow-sm transition-colors duration-200">
                                                <i class="fas fa-check mr-1.5"></i>
                                                Approve
                                            </button>
                                        </form>

                                        <a href="{{ route('pengembalian.denda', $pengembalian->id) }}"
                                           class="w-full inline-flex items-center justify-center px-3 py-1.5 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm transition-colors duration-200">
                                            <i class="fas fa-exclamation-triangle mr-1.5"></i>
                                            Tandai Rusak
                                        </a>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic text-sm">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-undo text-2xl text-gray-400"></i>
                                    </div>
                                    <p class="text-lg font-medium">Belum ada data pengembalian</p>
                                    <p class="text-sm">Silakan tunggu pengembalian baru</p>
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
