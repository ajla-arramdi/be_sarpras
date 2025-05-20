<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang', 
        'jumlah', 
        'kategori_id', 
        'code',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
