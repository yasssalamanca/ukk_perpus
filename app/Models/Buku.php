<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'keterangan',
        'cover_buku',
    ];

    // Relasi: 1 Buku bisa dipinjam berkali-kali (punya banyak history Peminjaman)
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
