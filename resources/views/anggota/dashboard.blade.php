@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('content')
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
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 0.85rem;
            margin: 0;
            opacity: 0.8;
        }
    </style>

    <div class="mb-3">
        <h1>Halo, {{ Auth::user()->name }}!</h1>
        <p>Selamat datang di Perpustakaan SMK PGRI 35 Solokanjeruk. Mau baca apa hari ini?</p>
    </div>

    <div class="dashboard-grid">
        <div class="stat-card" style="background-color: #f59e0b;">
            <h3>Buku di Tangan</h3>
            <div class="number">{{ $totalPinjam }}</div>
            <p>Segera kembalikan jika sudah selesai ya!</p>
        </div>

        <div class="stat-card" style="background-color: #10b981;">
            <h3>Riwayat Selesai</h3>
            <div class="number">{{ $totalSelesai }}</div>
            <p>Buku yang sudah kamu kembalikan.</p>
        </div>
    </div>

    <div class="mt-4" style="text-align: center; margin-top: 30px;">
        <a href="{{ route('anggota.pinjam') }}" class="btn bg-primary" style="display: inline-block; width: auto; padding: 12px 30px; font-size: 1.1rem; border-radius: 50px;">
            Mulai Cari Buku di Katalog
        </a>
    </div>
@endsection
