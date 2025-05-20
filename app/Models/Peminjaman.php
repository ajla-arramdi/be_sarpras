<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $fillable = [
        'user_id',
        'barang_id',
        // 'nama_peminjam',
        'kelas_peminjam',
        'keterangan',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'status',
    ];
    

public function user()
{
    return $this->belongsTo(User::class);
}

public function barang()
{
    return $this->belongsTo(Barang::class);
}
public function pengembalian()
{
    return $this->hasOne(Pengembalian::class);
}


    
}
