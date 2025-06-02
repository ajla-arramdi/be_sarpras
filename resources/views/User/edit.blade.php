@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('subtitle', 'Perbarui data pengguna sistem')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg relative mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button onclick="this.parentElement.remove()" class="absolute right-3 top-2 text-lg">&times;</button>
            </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-user text-lg"></i>
                    </span>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nama lengkap" />
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope text-lg"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan email" />
                </div>
            </div>

            <!-- Kata Sandi -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Kata Sandi (Opsional)
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock text-lg"></i>
                    </span>
                    <input type="password" name="password" id="password"
                        class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Kosongkan jika tidak ingin mengganti password" />
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6">
                <a href="{{ route('user.index') }}" 
                    class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
