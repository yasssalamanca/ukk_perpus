@extends('layouts.app')

@section('title', 'Tambah Anggota Baru')

@section('content')
    <div class="card" style="max-width: 600px;">
        <div class="card-header bg-success">
            <h2>Tambah Data Anggota</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('pustakawan.anggota.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS unik" required value="{{ old('nis') }}">
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama anggota" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: 10 TKJ 1" required value="{{ old('kelas') }}">
                </div>

                <div class="form-group">
                    <label>Email (Untuk Login)</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>Password Akun</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn bg-success">Simpan Anggota</button>
                    <a href="{{ route('pustakawan.anggota') }}" class="btn" style="background-color: #6c757d; text-align: center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
