@extends('layouts.app')

@section('title', 'Buat Peminjaman Baru')

@section('content')
    <div class="card" style="max-width: 600px;">
        <div class="card-header bg-primary">
            <h2>Buat Transaksi Peminjaman</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('pustakawan.transaksi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Anggota (Peminjam)</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($anggotas as $anggota)
                            <option value="{{ $anggota->id }}">{{ $anggota->nis }} - {{ $anggota->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Buku</label>
                    <select name="buku_id" class="form-control" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach ($bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->judul }} (Sisa Stok: {{ $buku->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Buku yang Dipinjam</label>
                    <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                    <small style="color: #666;">Pastikan jumlah tidak melebihi stok buku.</small>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn bg-primary">Proses Peminjaman</button>
                    <a href="{{ route('pustakawan.transaksi') }}" class="btn" style="background-color: #6c757d; text-align: center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
