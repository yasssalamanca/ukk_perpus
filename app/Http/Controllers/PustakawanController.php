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

    // === 2. KELOLA DATA ANGGOTA ===
    public function indexAnggota(Request $request)
    {
        // Fitur Pencarian Anggota (Berdasarkan Nama atau NIS)
        $query = User::where('role', 'anggota');
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }
        $anggotas = $query->paginate(10);
        return view('pustakawan.anggota.index', compact('anggotas'));
    }

    public function createAnggota()
    {
        return view('pustakawan.anggota.create');
    }

    public function storeAnggota(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users',
            'name' => 'required',
            'kelas' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'anggota' // Otomatis jadi anggota
        ]);

        return redirect()->route('pustakawan.anggota')->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    public function editAnggota(User $anggota)
    {
        return view('pustakawan.anggota.edit', compact('anggota'));
    }

    public function updateAnggota(Request $request, User $anggota)
    {
        // Validasi unik kecuali untuk ID anggota ini sendiri
        $request->validate([
            'nis' => 'required|unique:users,nis,' . $anggota->id,
            'name' => 'required',
            'kelas' => 'required',
            'email' => 'required|email|unique:users,email,' . $anggota->id,
            'password' => 'nullable|min:6' // Password opsional saat diedit
        ]);

        $data = $request->only(['nis', 'name', 'kelas', 'email']);

        // Kalau password diisi baru, maka update dan hash. Kalau kosong, abaikan.
        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $anggota->update($data);
        return redirect()->route('pustakawan.anggota')->with('success', 'Data anggota berhasil diupdate!');
    }

    public function destroyAnggota(User $anggota)
    {
        $anggota->delete();
        return redirect()->route('pustakawan.anggota')->with('success', 'Anggota berhasil dihapus!');
    }

    // === 3. KELOLA TRANSAKSI (PEMINJAMAN) ===
    public function indexTransaksi(Request $request)
    {
        // Ambil data peminjaman beserta data relasinya (Eager Loading) biar database ga ngos-ngosan
        $query = Peminjaman::with(['user', 'buku'])->latest();

        // Fitur Pencarian berdasarkan Kode Transaksi
        if ($request->has('search')) {
            $query->where('kode_transaksi', 'like', '%' . $request->search . '%');
        }

        $transaksis = $query->paginate(10);
        return view('pustakawan.transaksi.index', compact('transaksis'));
    }

    public function createTransaksi()
    {
        // PENTING: Cuma ambil anggota, dan ambil buku yang STOKNYA LEBIH DARI 0
        $anggotas = User::where('role', 'anggota')->get();
        $bukus = Buku::where('stok', '>', 0)->get();
        return view('pustakawan.transaksi.create', compact('anggotas', 'bukus'));
    }
    public function storeTransaksi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // Pengaman: Cek lagi stoknya, takutnya ada yang ngakalin form dari Inspect Element
        if ($buku->stok < 1) {
            return back()->with('error', 'Gagal! Stok buku ini sudah habis.');
        }

        // 1. Simpan data peminjaman
        Peminjaman::create([
            'kode_transaksi' => 'TRX-' . date('Ymd') . '-' . rand(1000, 9999),
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now()->toDateString(), // Tanggal hari ini
            'status' => 'dipinjam'
        ]);

        // 2. Kurangi stok buku
        $buku->decrement('stok');

        return redirect()->route('pustakawan.transaksi')->with('success', 'Transaksi berhasil! Stok buku otomatis berkurang.');
    }

    public function kembaliTransaksi($id)
    {
        $transaksi = Peminjaman::findOrFail($id);

        // Pengaman: Jangan sampai transaksi yang udah selesai diklik kembali lagi (nanti stoknya nambah terus)
        if ($transaksi->status === 'dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya!');
        }

        // 1. Update status dan tanggal kembali
        $transaksi->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()->toDateString()
        ]);

        // 2. Kembalikan stok buku
        $buku = Buku::findOrFail($transaksi->buku_id);
        $buku->increment('stok');

        return redirect()->route('pustakawan.transaksi')->with('success', 'Buku berhasil dikembalikan! Stok buku bertambah.');
    }
}
