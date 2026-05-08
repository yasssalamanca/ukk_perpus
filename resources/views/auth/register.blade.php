@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <div class="card" style="max-width: 500px;">
        <div class="card-header bg-success">
            <h2>Daftar Anggota Baru</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('register.proses') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: 12 RPL 2" required>
                </div>
                <div class="form-group">
                    <label>Email (Untuk Login)</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 Karakter" required minlength="6">
                </div>
                <button type="submit" class="btn bg-success">Daftar Sekarang</button>
            </form>
            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="link-success"> Login di sini</a></p>
            </div>
        </div>
    </div>
@endsection
