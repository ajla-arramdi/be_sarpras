@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 text-gray-700 font-sans">

    <h1 class="text-4xl font-extrabold text-teal-900 mb-12 tracking-tight">Dashboard Admin</h1>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        @php
            $cards = [
                ['icon' => 'fas fa-folder', 'label' => 'Total Kategori', 'value' => $totalKategori, 'color' => 'blue'],
                ['icon' => 'fas fa-box', 'label' => 'Total Barang', 'value' => $totalBarang, 'color' => 'green'],
                ['icon' => 'fas fa-hand-holding', 'label' => 'Total Peminjaman', 'value' => $totalPeminjaman, 'color' => 'yellow'],
                ['icon' => 'fas fa-undo', 'label' => 'Total Pengembalian', 'value' => $totalPengembalian, 'color' => 'red'],
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="bg-white rounded-2xl shadow-md border-l-8 border-{{ $card['color'] }}-400 hover:shadow-lg transition duration-300 ease-in-out p-6 flex items-center space-x-5">
            <div class="text-4xl text-{{ $card['color'] }}-500">
                <i class="{{ $card['icon'] }}"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold">{{ $card['label'] }}</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $card['value'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Kategori Terbaru --}}
    <section class="mb-12">
        <h2 class="text-2xl font-semibold text-teal-800 mb-5 border-b-2 border-teal-300 pb-2">Kategori Terbaru</h2>
        <div class="bg-white rounded-2xl shadow border border-teal-200 p-6">
            <ul class="list-disc list-inside space-y-2 text-gray-700 text-lg">
                @forelse ($recentKategori as $kategori)
                    <li class="hover:text-teal-600 transition cursor-default">{{ $kategori->nama_kategori ?? 'Kategori kosong' }}</li>
                @empty
                    <li class="italic text-gray-400">Tidak ada data kategori.</li>
                @endforelse
            </ul>
        </div>
    </section>

    {{-- Tabel Terbaru (Barang, Peminjaman, Pengembalian) --}}
    @php
        $tables = [
            [
                'title' => 'Barang Terbaru',
                'headers' => ['Nama Barang', 'Kategori', 'Stok'],
                'fields' => ['nama_barang', 'kategori.nama_kategori', 'stok'],
                'items' => $recentBarang,
                'cols_span' => 3,
            ],
            [
                'title' => 'Peminjaman Terbaru',
                'headers' => ['User', 'Barang', 'Tanggal Pinjam', 'Status'],
                'fields' => ['user.name', 'barang.nama_barang', 'tanggal_pinjam', 'status'],
                'items' => $recentPeminjaman,
                'cols_span' => 4,
            ],
            [
                'title' => 'Pengembalian Terbaru',
                'headers' => ['User', 'Barang', 'Tanggal Kembali', 'Status'],
                'fields' => ['user.name', 'peminjaman.barang.nama_barang', 'tanggal_kembali', 'status'],
                'items' => $recentPengembalian,
                'cols_span' => 4,
            ],
        ];
    @endphp

    @foreach ($tables as $table)
    <section class="mb-12">
        <h2 class="text-2xl font-semibold text-teal-800 mb-5 border-b-2 border-teal-300 pb-2">{{ $table['title'] }}</h2>
        <div class="overflow-x-auto bg-white rounded-2xl shadow border border-teal-200">
            <table class="min-w-full text-gray-800 border-collapse">
                <thead class="bg-teal-50">
                    <tr>
                        @foreach ($table['headers'] as $header)
                        <th class="px-8 py-4 border-b border-teal-300 font-semibold text-teal-700 text-left tracking-wide text-sm">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($table['items'] as $item)
                        <tr class="hover:bg-teal-100 transition cursor-pointer">
                            @foreach ($table['fields'] as $field)
                                @php
                                    // Support nested fields with dot notation
                                    $value = data_get($item, $field, '-');
                                @endphp
                                @if ($field === 'status')
                                    <td class="px-8 py-4 border-b border-teal-200">
                                        @if ($value === 'selesai')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-sm">
                                                <i class="fas fa-check-circle mr-2"></i> Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-200 text-yellow-800 font-semibold text-sm">
                                                <i class="fas fa-clock mr-2"></i> Menunggu
                                            </span>
                                        @endif
                                    </td>
                                @else
                                    <td class="px-8 py-4 border-b border-teal-200">{{ $value }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $table['cols_span'] }}" class="px-8 py-6 text-center italic text-gray-400 border-b border-teal-200">Tidak ada data {{ strtolower($table['title']) }}.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    @endforeach

</div>
@endsection
