@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('subtitle', 'Ubah detail kategori yang ada')

@section('content')
<div class="space-y-6">
    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div class="space-y-2">
                <label for="nama" class="block text-sm font-medium text-gray-700">
                    Nama Kategori
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-box text-lg"></i>
                    </span>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           required
                           value="{{ old('nama', $kategori->nama) }}"
                           class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                           placeholder="Masukkan nama kategori" />
                </div>
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6">
                <a href="{{ route('kategori.index') }}" 
                   class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>

                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 rounded-lg bg-gradient-to-r from-red-600 to-red-700 text-white font-medium hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
