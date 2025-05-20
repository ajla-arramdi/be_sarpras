@extends('layouts.admin')

@section('title', 'Daftar Barang')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-blue-700">📦 Daftar Barang</h2>
    <a href="{{ route('barang.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
        ➕ Tambah Barang
    </a>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-blue-100">
        <thead class="bg-blue-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Foto</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Nama Barang</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Jumlah</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse($barangs as $barang)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4 text-gray-700">{{ $barang->id }}</td>
                    <td class="px-6 py-4">
                        @if ($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}"
                                 alt="Foto {{ $barang->nama_barang }}"
                                 class="w-12 h-12 object-cover rounded shadow-sm">
                        @else
                            <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $barang->nama_barang }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $barang->jumlah }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $barang->kategori->nama ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('barang.edit', $barang->id) }}"
                               class="px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-sm font-medium text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada barang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
