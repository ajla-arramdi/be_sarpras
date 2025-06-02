@extends('layouts.admin')

@section('title', 'Daftar Pengguna')
@section('subtitle', 'Kelola akun pengguna yang memiliki akses sistem')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-users text-2xl text-red-600"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
                <p class="text-sm text-gray-600">Total {{ $users->count() }} pengguna</p>
            </div>
        </div>
        <a href="{{ route('user.create') }}"
           class="inline-flex items-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-red-600 to-red-700 text-white font-medium hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
            <i class="fas fa-plus mr-2"></i>
            Tambah Pengguna
        </a>
    </div>

    <!-- Flash Message -->
    @if (session('berhasil'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg relative">
            <span>{{ session('berhasil') }}</span>
            <button onclick="this.parentElement.remove()" class="absolute right-3 top-2 text-lg">&times;</button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('user.edit', $user->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 transition">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 transition">
                                            <i class="fas fa-trash-alt mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-users text-4xl mb-3"></i>
                                    <p class="text-lg font-medium">Tidak ada pengguna</p>
                                    <p class="text-sm">Silakan tambahkan pengguna baru</p>
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
