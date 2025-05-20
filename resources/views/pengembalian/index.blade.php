@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pengembalian</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Dikembalikan</th>
                <th>Jumlah</th>
                <th>Kondisi Barang</th>
                <th>Denda</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengembalians as $pengembalian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengembalian->user->name }}</td>
                    <td>{{ $pengembalian->peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $pengembalian->tanggal_dikembalikan }}</td>
                    <td>{{ $pengembalian->jumlah }}</td>
                    <td>{{ ucfirst($pengembalian->kondisi_barang) }}</td>
                    <td>Rp{{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                    <td>{{ $pengembalian->catatan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pengembalian.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
