@extends('layouts.app')

@section('title', 'Kelola Data Buku')

@section('content')
<div class="d-flex justify-between align-center mb-3">
    <h2>Daftar Buku</h2>
    <a href="{{ route('pustakawan.buku.create') }}" class="btn bg-success" style="width: auto;">+ Tambah Buku</a>
</div>

<form action="{{ route('pustakawan.buku') }}" method="GET" class="search-form mb-3">
    <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
    <button type="submit" class="btn bg-primary">Cari</button>
</form>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bukus as $index => $buku)
            <tr>
                <td>{{ $bukus->firstItem() + $index }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->penerbit }}</td>
                <td>{{ $buku->tahun_terbit }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('pustakawan.buku.edit', $buku->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('pustakawan.buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data buku.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $bukus->links() }}
    </div>
</div>
@endsection
