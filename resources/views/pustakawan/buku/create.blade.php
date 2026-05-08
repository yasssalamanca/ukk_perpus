@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header bg-primary">
        <h2>Tambah Data Buku</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('pustakawan.buku.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" required value="{{ old('judul') }}">
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" placeholder="Nama penulis" required value="{{ old('penulis') }}">
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" placeholder="Nama penerbit" required value="{{ old('penerbit') }}">
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024" required value="{{ old('tahun_terbit') }}">
            </div>

            <div class="form-group">
                <label>Keterangan / Sinopsis (Opsional)</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan singkat buku ini">{{ old('keterangan') }}</textarea>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn bg-primary">Simpan Buku</button>
                <a href="{{ route('pustakawan.buku') }}" class="btn" style="background-color: #6c757d; text-align: center;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
