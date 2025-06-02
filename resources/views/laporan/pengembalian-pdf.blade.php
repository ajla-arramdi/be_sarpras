<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-completed {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-damage {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .kondisi {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .kondisi-baik {
            background-color: #dcfce7;
            color: #166534;
        }
        .kondisi-terlambat {
            background-color: #fef3c7;
            color: #92400e;
        }
        .kondisi-rusak {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .kondisi-hilang {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pengembalian</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pengembali</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $pengembalian)
            <tr>
                <td>#{{ $pengembalian->id }}</td>
                <td>{{ $pengembalian->user->name }}</td>
                <td>
                    {{ $pengembalian->peminjaman->barang->nama_barang }}<br>
                    <small>{{ $pengembalian->peminjaman->barang->code }}</small>
                </td>
                <td>{{ $pengembalian->jumlah }}</td>
                <td>{{ $pengembalian->tanggal_dikembalikan }}</td>
                <td>
                    <span class="kondisi kondisi-{{ $pengembalian->kondisi_barang }}">
                        {{ ucfirst($pengembalian->kondisi_barang) }}
                    </span>
                </td>
                <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                <td>
                    <span class="status status-{{ $pengembalian->status }}">
                        {{ ucfirst($pengembalian->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html> 