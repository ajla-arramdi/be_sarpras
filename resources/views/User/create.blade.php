@extends('layouts.admin')

@section('title', 'Tambah Pengguna')
@section('subtitle', 'Isi data pengguna yang akan ditambahkan ke sistem')

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-2xl mx-auto">
        <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg relative">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button onclick="this.parentElement.remove()" class="absolute right-3 top-2 text-lg">&times;</button>
                </div>
            @endif

            <!-- Nama Lengkap -->
            <div class="space-y-1.5">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-user text-md"></i>
                    </span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="pl-10 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                        placeholder="Masukkan nama lengkap pengguna">
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-1.5">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope text-md"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="pl-10 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                        placeholder="Masukkan email pengguna">
                </div>
            </div>

            <!-- Kata Sandi -->
            <div class="space-y-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Kata Sandi <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock text-md"></i>
                    </span>
                    <input type="password" id="password" name="password" required
                        class="pl-10 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                        placeholder="Masukkan kata sandi">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 gap-4">
                <a href="{{ route('user.index') }}"
                    class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i> Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
