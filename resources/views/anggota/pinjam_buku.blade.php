@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
    <h2>Katalog Buku Tersedia</h2>
    <form action="{{ route('anggota.pinjam') }}" method="GET" class="search-form mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari judul buku..." value="{{ request('search') }}">
        <button type="submit" class="btn bg-primary">Cari</button>
    </form>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
        @foreach ($bukus as $buku)
            <div class="card" style="margin: 0; max-width: 100%;">
                <div style="height: 250px; background: #eee; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    @if ($buku->cover_buku)
                        <img src="{{ asset('storage/cover_buku/' . $buku->cover_buku) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span>No Cover</span>
                    @endif
                </div>
                <div class="card-body" style="padding: 15px;">
                    <h4 style="margin-bottom: 5px;">{{ $buku->judul }}</h4>
                    <p style="font-size: 0.8rem; color: #666;">Stok: {{ $buku->stok }}</p>
                    <p style="font-size: 0.8rem; margin-top: 10px;">Silahkan hubungi petugas di meja Pustakawan untuk meminjam buku ini.</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
