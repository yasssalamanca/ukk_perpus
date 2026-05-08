@extends('layouts.app')

@section('title', 'Edit Data Anggota')

@section('content')
    <div class="card" style="max-width: 600px;">
        <div class="card-header bg-warning" style="color: black;">
            <h2>Edit Data Anggota</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('pustakawan.anggota.update', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>NIS</label>
                    <input type="text" name="nis" class="form-control" required value="{{ old('nis', $anggota->nis) }}">
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $anggota->name) }}">
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" required value="{{ old('kelas', $anggota->kelas) }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $anggota->email) }}">
                </div>

                <div class="form-group">
                    <label>Ganti Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
                    <small style="color: #666;">Minimal 6 karakter.</small>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn bg-warning" style="color: black;">Update Anggota</button>
                    <a href="{{ route('pustakawan.anggota') }}" class="btn" style="background-color: #6c757d; text-align: center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
