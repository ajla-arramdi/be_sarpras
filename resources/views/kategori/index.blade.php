@extends('layouts.admin')

@section('title', 'Daftar Kategori')
@section('subtitle', 'Kelola kategori barang dalam sistem')

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

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
            </div>
            <div>
                <p class="font-medium">Error!</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    {{-- Header + Add Button --}}
    <div class="flex justify-between items-center mb-8 border-b border-teal-300 pb-4">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-boxes text-2xl text-teal-700"></i>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-teal-900 tracking-tight">Daftar Kategori</h2>
                <p class="text-sm text-teal-700">Total {{ $kategori->count() }} kategori</p>
            </div>
        </div>
        <a href="{{ route('kategori.create') }}"
           class="inline-flex items-center px-6 py-3 rounded-xl bg-gradient-to-r from-teal-600 to-teal-700 text-white font-semibold shadow-md hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:ring-4 focus:ring-teal-300 transition">
            <i class="fas fa-plus mr-3"></i> Tambah Kategori
        </a>
    </div>

    {{-- Table Card --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow border border-teal-200">
        <table class="min-w-full text-gray-800 border-collapse">
            <thead class="bg-teal-50">
                <tr>
                    <th class="px-8 py-4 border-b border-teal-300 font-semibold text-teal-700 text-left tracking-wide text-sm">ID</th>
                    <th class="px-8 py-4 border-b border-teal-300 font-semibold text-teal-700 text-left tracking-wide text-sm">Nama Kategori</th>
                    <th class="px-8 py-4 border-b border-teal-300 font-semibold text-teal-700 text-center tracking-wide text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $item)
                    <tr class="hover:bg-teal-100 transition cursor-pointer">
                        <td class="px-8 py-4 border-b border-teal-200">#{{ $item->id }}</td>
                        <td class="px-8 py-4 border-b border-teal-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-box text-teal-600"></i>
                                </div>
                                <div class="text-sm font-semibold text-teal-900">{{ $item->nama }}</div>
                            </div>
                        </td>
                        <td class="px-8 py-4 border-b border-teal-200 text-center space-x-4 whitespace-nowrap">
                            <a href="{{ route('kategori.edit', $item->id) }}" 
                               class="inline-flex items-center px-4 py-2 rounded-lg text-teal-700 bg-teal-100 hover:bg-teal-200 font-semibold transition-shadow shadow-sm">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 rounded-lg text-red-700 bg-red-100 hover:bg-red-200 font-semibold transition-shadow shadow-sm">
                                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center italic text-gray-400">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <i class="fas fa-boxes text-6xl"></i>
                                <p class="text-2xl font-semibold">Tidak ada kategori tersedia</p>
                                <p class="text-sm text-gray-500">Silakan tambahkan kategori baru</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
