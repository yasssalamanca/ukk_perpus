<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

class PustakawanController extends Controller
{
    // === 1. KELOLA DATA BUKU ===
    public function indexBuku(Request $request)
    {
        // Fitur Pencarian Buku
        $query = Buku::query();
        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('penulis', 'like', '%' . $request->search . '%');
        }
        $bukus = $query->paginate(10); // Tampil 10 buku per halaman
        return view('pustakawan.buku.index', compact('bukus'));
    }

    public function createBuku()
    {
        return view('pustakawan.buku.create');
    }

    public function storeBuku(Request $request)
    {
        // 1. Validasi ditambahin untuk stok dan file gambar
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric|min:0',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        $data = $request->all();

        // 2. Logika Upload Gambar
        if ($request->hasFile('cover_buku')) {
            $file = $request->file('cover_buku');
            // Bikin nama file unik pakai waktu (biar kalau ada nama file sama nggak ketimpa)
            $filename = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder storage/app/public/cover_buku
            $file->storeAs('public/cover_buku', $filename);
            // Masukin nama filenya ke array data buat disimpen ke database
            $data['cover_buku'] = $filename;
        }

        Buku::create($data);
        return redirect()->route('pustakawan.buku')->with('success', 'Buku beserta cover berhasil ditambahkan!');
    }

    public function editBuku(Buku $buku)
    {
        return view('pustakawan.buku.edit', compact('buku'));
    }

    public function updateBuku(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric|min:0',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Logika Update Gambar
        if ($request->hasFile('cover_buku')) {
            // Hapus gambar lama dulu dari folder biar hardisk nggak penuh
            if ($buku->cover_buku && Storage::exists('public/cover_buku/' . $buku->cover_buku)) {
                Storage::delete('public/cover_buku/' . $buku->cover_buku);
            }
            // Upload gambar baru
            $file = $request->file('cover_buku');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cover_buku', $filename);
            $data['cover_buku'] = $filename;
        }

        $buku->update($data);
        return redirect()->route('pustakawan.buku')->with('success', 'Data buku berhasil diupdate!');
    }

    public function destroyBuku(Buku $buku)
    {
        // Sebelum datanya dihapus di database, hapus dulu file fisiknya!
        if ($buku->cover_buku && Storage::exists('public/cover_buku/' . $buku->cover_buku)) {
            Storage::delete('public/cover_buku/' . $buku->cover_buku);
        }
        $buku->delete();
        return redirect()->route('pustakawan.buku')->with('success', 'Buku beserta gambarnya berhasil dihapus!');
    }

    public function dashboard()
    {
        // Mengambil statistik data
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalPinjam = Peminjaman::where('status', 'dipinjam')->count();

        return view('pustakawan.dashboard', compact('totalBuku', 'totalAnggota', 'totalPinjam'));
    }
}
