@extends('layouts.app')

@section('title', 'Edit Data Buku')

@section('content')
 <div class="card" style="max-width: 600px;">
 <div class="card-header bg-success">
 <h2>Edit Data Buku</h2>
 </div>
 <div class="card-body">
 <form action="{{ route('pustakawan.buku.update', $buku->id) }}"
method="POST" enctype="multipart/form-data">
 @csrf
 @method('PUT')

 <div class="form-group">
 <label>Judul Buku</label>
 <input type="text" name="judul" class="form-control" required
value="{{ old('judul', $buku->judul) }}">
 </div>

 <div class="form-group">
 <label>Penulis</label>
 <input type="text" name="penulis" class="form-control" required
 value="{{ old('penulis', $buku->penulis) }}">
 </div>

 <div class="form-group">
 <label>Penerbit</label>
 <input type="text" name="penerbit" class="form-control" required
 value="{{ old('penerbit', $buku->penerbit) }}">
 </div>

 <div class="form-group">
 <label>Tahun Terbit</label>
 <input type="number" name="tahun_terbit" class="form-control" required
 value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
 </div>

 <div class="form-group">
 <label>Keterangan / Sinopsis (Opsional)</label>
 <textarea name="keterangan" class="form-control"
 rows="3">{{ old('keterangan', $buku->keterangan) }}</textarea>
 </div>

 <div class="form-group">
 <label>Stok Buku</label>
 <input type="number" name="stok" class="form-control" required
min="0"
 value="{{ old('stok', $buku->stok) }}">
 </div>

 <div class="form-group">
 <label>Ganti Cover Buku (Opsional)</label>
 @if($buku->cover_buku)
 <div style="margin-bottom: 10px;">
 <img src="{{ asset('storage/cover_buku/' . $buku->cover_buku) }}"
alt="Cover Lama" width="100"
 style="border-radius: 5px;">
 </div>
 @endif
 <input type="file" name="cover_buku" class="form-control"
accept="image/*">
 <small style="color: #666;">Biarkan kosong jika tidak ingin mengganti cover.</small>
 </div>

 <div class="d-flex gap-2 mt-3">
 <button type="submit" class="btn bg-success">Update Buku</button>
 <a href="{{ route('pustakawan.buku') }}" class="btn"
 style="background-color: #6c757d; text-align: center;">Batal</a>
 </div>
 </form>
 </div>
 </div>
@endsection
