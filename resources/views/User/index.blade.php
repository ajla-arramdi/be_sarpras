@extends('layouts.admin')

@section('title', 'Daftar Pengguna')
@section('subtitle', 'Kelola akun pengguna yang memiliki akses sistem')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 text-slate-700 font-sans">

    {{-- Header + Tombol Tambah --}}
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-teal-300">
        <h2 class="text-4xl font-extrabold text-teal-900 tracking-tight">Daftar Pengguna</h2>
        <a href="{{ route('user.create') }}" 
           class="inline-flex items-center px-6 py-3 rounded-xl bg-gradient-to-r from-teal-500 to-teal-600 text-white font-semibold shadow-md hover:from-teal-600 hover:to-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-300 transition-all">
            <i class="fas fa-user-plus mr-3"></i> Tambah Pengguna
        </a>
    </div>

    {{-- Tabel Pengguna --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow border border-gray-200">
        <table class="min-w-full border-collapse text-sm text-slate-800">
            <thead class="bg-teal-50">
                <tr>
                    <th class="px-6 py-4 border-b border-gray-200 font-semibold text-teal-700 text-left">No</th>
                    <th class="px-6 py-4 border-b border-gray-200 font-semibold text-teal-700 text-left">Nama</th>
                    <th class="px-6 py-4 border-b border-gray-200 font-semibold text-teal-700 text-left">Email</th>
                    <th class="px-6 py-4 border-b border-gray-200 font-semibold text-teal-700 text-left">Role</th>
                    <th class="px-6 py-4 border-b border-gray-200 font-semibold text-teal-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr class="hover:bg-teal-50 transition-all">
                    <td class="px-6 py-4 border-b border-gray-100">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 border-b border-gray-100">{{ $user->name }}</td>
                    <td class="px-6 py-4 border-b border-gray-100 truncate max-w-xs">{{ $user->email }}</td>
                    <td class="px-6 py-4 border-b border-gray-100 text-teal-600 font-semibold capitalize">{{ $user->role ?? 'Belum Ditentukan' }}</td>
                    <td class="px-6 py-4 border-b border-gray-100 text-center space-x-2">
                        <a href="{{ route('user.edit', $user->id) }}" 
                           class="inline-flex items-center px-4 py-2 rounded-lg text-teal-700 bg-teal-100 hover:bg-teal-200 font-semibold transition-all shadow-sm">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 rounded-lg text-red-700 bg-red-100 hover:bg-red-200 font-semibold transition-all shadow-sm">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center italic text-slate-400">
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <i class="fas fa-users text-6xl text-slate-300"></i>
                            <p class="text-2xl font-semibold">Tidak ada pengguna</p>
                            <p class="text-sm text-slate-500">Silakan tambahkan pengguna baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
