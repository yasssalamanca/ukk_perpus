<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalPinjam = Peminjaman::where('user_id', $user->id)->where('status', 'dipinjam')->count();
        $totalSelesai = Peminjaman::where('user_id', $user->id)->where('status', 'dikembalikan')->count();
        return view('anggota.dashboard', compact('totalPinjam', 'totalSelesai'));
    }

    // Menu "Pinjam Buku" (Katalog Buku yang Tersedia)
    public function bukuTersedia(Request $request)
    {
        $query = Buku::where('stok', '>', 0);

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        $bukus = $query->paginate(8);
        return view('anggota.pinjam_buku', compact('bukus'));
    }

    // Menu "Kembalikan Buku" (Daftar Buku yang Sedang Dipinjam)
    public function peminjamanSaya()
    {
        $pinjamans = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->get();
        return view('anggota.kembalikan_buku', compact('pinjamans'));
    }
}
