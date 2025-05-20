@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-blue-700">📂 Daftar Kategori</h2>
    <a href="{{ route('kategori.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
        ➕ Tambah Kategori
    </a>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-blue-100">
        <thead class="bg-blue-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Nama Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-blue-600 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse($kategori as $kategori)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $kategori->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $kategori->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-3">
                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                               class="px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada kategori tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
