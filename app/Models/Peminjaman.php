<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Kunci nama tabel biar nggak diplesetin sama bahasa Inggris
    protected $table = 'peminjamans';

    // Kolom yang diizinkan untuk diisi data
    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'buku_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Relasi: 1 Peminjaman dimiliki oleh 1 User (Anggota)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 Peminjaman berisi 1 Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
