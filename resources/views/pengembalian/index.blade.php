@extends('layouts.admin')

@section('title', 'Daftar Pengembalian')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">📦 Daftar Pengembalian</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-blue-100">
            <thead class="bg-blue-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Nama User</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Tanggal Pinjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-blue-600 uppercase">Tanggal Kembali</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-blue-600 uppercase">Jumlah</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-blue-600 uppercase">Kondisi</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold text-blue-600 uppercase">Denda</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-blue-600 uppercase">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-blue-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($pengembalians as $pengembalian)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-4 py-3 text-gray-800 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-gray-800 whitespace-nowrap">{{ $pengembalian->user->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-800 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-gray-800 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-800 whitespace-nowrap">{{ $pengembalian->jumlah }}</td>
                        <td class="px-4 py-3 text-center capitalize text-gray-800 whitespace-nowrap">{{ $pengembalian->kondisi_barang }}</td>
                        <td class="px-4 py-3 text-right text-gray-800 whitespace-nowrap">
                            Rp{{ number_format($pengembalian->total_denda, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if ($pengembalian->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif ($pengembalian->status === 'complete') bg-green-100 text-green-800
                                @elseif ($pengembalian->status === 'damage') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-600
                                @endif
                            ">
                                {{ ucfirst($pengembalian->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            @if ($pengembalian->status === 'pending')
                                <div class="flex flex-col gap-2 max-w-[120px] mx-auto">
                                    <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST" onsubmit="return confirm('Setujui pengembalian ini?')">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-3 py-1 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded shadow">
                                            ✅ Approve
                                        </button>
                                    </form>

                                    <a href="{{ route('pengembalian.denda', $pengembalian->id) }}"
                                       class="block w-full px-3 py-1 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded shadow text-center">
                                        ❌ Tandai Rusak
                                    </a>
                                </div>
                            @else
                                <span class="text-gray-500 italic text-xs">Tidak ada aksi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">
                            Belum ada data pengembalian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
