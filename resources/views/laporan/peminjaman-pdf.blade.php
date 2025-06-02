<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
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
        .status-menunggu {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-disetujui {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .status-dikembalikan {
            background-color: #dbeafe;
            color: #1e40af;
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
        <h1>Laporan Peminjaman</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
            <tr>
                <td>#{{ $peminjaman->id }}</td>
                <td>{{ $peminjaman->user->name }}</td>
                <td>
                    {{ $peminjaman->barang->nama_barang }}<br>
                    <small>{{ $peminjaman->barang->code }}</small>
                </td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_kembali }}</td>
                <td>
                    <span class="status status-{{ $peminjaman->status }}">
                        {{ ucfirst($peminjaman->status) }}
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