@extends('layouts.app')

@section('title', 'Kelola Data Anggota')

@section('content')
    <div class="d-flex justify-between align-center mb-3">
        <h2>Daftar Anggota Perpustakaan</h2>
        <a href="{{ route('pustakawan.anggota.create') }}" class="btn bg-success" style="width: auto;">+ Tambah Anggota</a>
    </div>

    <form action="{{ route('pustakawan.anggota') }}" method="GET" class="search-form mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari NIS atau Nama..." value="{{ request('search') }}">
        <button type="submit" class="btn bg-primary">Cari</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggotas as $index => $anggota)
                    <tr>
                        <td>{{ $anggotas->firstItem() + $index }}</td>
                        <td>{{ $anggota->nis }}</td>
                        <td>{{ $anggota->name }}</td>
                        <td>{{ $anggota->kelas }}</td>
                        <td>{{ $anggota->email }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('pustakawan.anggota.edit', $anggota->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pustakawan.anggota.destroy', $anggota->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus anggota ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data anggota yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $anggotas->links() }}
        </div>
    </div>
@endsection
