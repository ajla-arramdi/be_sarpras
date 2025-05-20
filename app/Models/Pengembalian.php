<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
      protected $fillable = [
        'user_id',
        'peminjaman_id',
        'jumlah',
        'tanggal_dikembalikan',
        'kondisi_barang',
        'denda',
        'status',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
