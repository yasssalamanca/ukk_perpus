@extends('layouts.app')

@section('title', 'Dashboard Pustakawan')

@section('content')
 <div class="mb-3">
 <h1>Dashboard Pustakawan</h1>
 <p>Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Berikut adalah ringkasan perpustakaan hari ini.</p>
 </div>
 <style>
 .dashboard-grid {
 display: grid;
 grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
 gap: 20px;
 margin-top: 20px;
 }
 .stat-card {
 padding: 20px;
 border-radius: 10px;
 color: white;
 display: flex;
 flex-direction: column;
 justify-content: space-between;
 min-height: 120px;
 box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
 }
 .stat-card h3 {
 font-size: 0.9rem;
 opacity: 0.9;
 margin-bottom: 10px;
 }
 .stat-card .number {
 font-size: 2rem;
 font-weight: bold;
 }
 .stat-link {
 margin-top: 15px;
 text-align: right;
 font-size: 0.8rem;
 text-decoration: underline;
 color: rgba(255, 255, 255, 0.8);
 }
 </style>
 <div class="dashboard-grid">
 <div class="stat-card" style="background-color: #0d6efd;">
 <h3>Total Koleksi Buku</h3>
 <div class="number">{{ $totalBuku }}</div>
 <a href="{{ route('pustakawan.buku') }}" class="stat-link">Lihat Detail →</a>
 </div>
 <div class="stat-card" style="background-color: #198754;">
 <h3>Total Anggota</h3>
 <div class="number">{{ $totalAnggota }}</div>
 <a href="{{ route('pustakawan.anggota') }}" class="stat-link">Kelola Anggota →</a>
 </div>
 <div class="stat-card" style="background-color: #f59e0b;">
 <h3>Buku Sedang Dipinjam</h3>
 <div class="number">{{ $totalPinjam }}</div>
 <a href="{{ route('pustakawan.transaksi') }}" class="stat-link">Lihat Transaksi →</a>
 </div>
 </div>

 <div class="card mt-3" style="max-width: 100%;">
 <div class="card-body">
 <h4>Menu Cepat</h4>
 <hr>
 <div class="d-flex gap-2 mt-3">
 <a href="{{ route('pustakawan.buku.create') }}" class="btn bg-primary"
style="width: auto;">+ Tambah Buku Baru</a>
 <a href="{{ route('pustakawan.anggota.create') }}" class="btn bg-success"
style="width: auto;">+ Daftarkan Anggota Baru</a>
 <a href="{{ route('pustakawan.transaksi.create') }}" class="btn bg-primary"
style="background-color: #6366f1; width: auto;">+ Buat Transaksi Pinjam</a>
 </div>
 </div>
 </div>
@endsection
