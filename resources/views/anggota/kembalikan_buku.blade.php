@extends('layouts.app')

@section('title', 'Buku Saya')

@section('content')
    <h2>Buku yang Sedang Kamu Pinjam</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjamans as $pinjam)
                    <tr>
                        <td>{{ $pinjam->buku->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ $pinjam->jumlah }}</td>
                        <td><span style="color: #f59e0b; font-weight: bold;">Harus Kembali</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Kamu tidak sedang meminjam buku apa pun.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
