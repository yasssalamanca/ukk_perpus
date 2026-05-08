<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
        ]);

        Buku::create($request->all());
        return redirect()->route('pustakawan.buku')->with('success', 'Buku berhasil ditambahkan!');
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
        ]);

        $buku->update($request->all());
        return redirect()->route('pustakawan.buku')->with('success', 'Data buku berhasil diupdate!');
    }

    public function destroyBuku(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('pustakawan.buku')->with('success', 'Buku berhasil dihapus!');
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
