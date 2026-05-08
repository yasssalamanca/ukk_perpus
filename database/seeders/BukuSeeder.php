<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'stok' => 10,
                'keterangan' => 'Kisah perjuangan 10 anak di Belitung.'
            ],
            [
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2014,
                'stok' => 5,
                'keterangan' => 'Petualangan dunia paralel.'
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2019,
                'stok' => 8,
                'keterangan' => 'Filsafat Stoic untuk kehidupan modern.'
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2009,
                'stok' => 12,
                'keterangan' => 'Man Jadda Wajada!'
            ],
            [
                'judul' => 'Dilan 1990',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => 2014,
                'stok' => 15,
                'keterangan' => 'Jangan rindu, berat. Kamu nggak akan kuat.'
            ],
            [
                'judul' => 'Perahu Kertas',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2009,
                'stok' => 7,
                'keterangan' => 'Kisah pencarian jati diri dan cinta.'
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2018,
                'stok' => 20,
                'keterangan' => 'Cara mudah membangun kebiasaan baik.'
            ],
            [
                'judul' => 'Sapiens',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'KPG',
                'tahun_terbit' => 2011,
                'stok' => 4,
                'keterangan' => 'Sejarah singkat umat manusia.'
            ],
            [
                'judul' => 'Hujan',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2016,
                'stok' => 6,
                'keterangan' => 'Tentang melupakan dan persahabatan.'
            ],
            [
                'judul' => 'Madre',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2011,
                'stok' => 9,
                'keterangan' => 'Kumpulan cerita pendek yang menyentuh.'
            ],
        ];

        foreach ($books as $book) {
            Buku::create($book);
        }
    }
}
