@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
<div class="d-flex justify-between align-center mb-3">
 <h2>Data Peminjaman Buku</h2>
 <a href="{{ route('pustakawan.transaksi.create') }}" class="btn bg-primary"
style="width: auto;">+ Buat Peminjaman</a>
</div>

<form action="{{ route('pustakawan.transaksi') }}" method="GET" class="search-form
mb-3">
 <input type="text" name="search" class="form-control" placeholder="Cari Kode
Transaksi (Contoh: TRX-)..." value="{{ request('search') }}">
 <button type="submit" class="btn bg-primary">Cari</button>
</form>

<div class="table-container">
 <table>
 <thead>
 <tr>
 <th>Kode TRX</th>
 <th>Peminjam</th>
 <th>Buku</th>
 <th>Tgl Pinjam</th>
 <th>Tgl Kembali</th>
 <th>Status</th>
 <th>Aksi</th>
 </tr>
 </thead>
 <tbody>
 @forelse($transaksis as $trx)
 <tr>
 <td><strong>{{ $trx->kode_transaksi }}</strong></td>
 <td>{{ $trx->user->name }}</td>
 <td>{{ $trx->buku->judul }}</td>
 <td>{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}
</td>
 <td>
 @if($trx->tanggal_kembali)
 {{ \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') }}
 @else
 -
 @endif
 </td>
 <td>
 @if($trx->status == 'dipinjam')
 <span style="background-color: #ffc107; color: black; padding: 4px 8px;
border-radius: 4px; font-size: 0.8rem; font-weight: bold;">Dipinjam</span>
 @else
 <span style="background-color: #198754; color: white; padding: 4px 8px;
border-radius: 4px; font-size: 0.8rem; font-weight: bold;">Dikembalikan</span>
 @endif
 </td>
 <td>
 @if($trx->status == 'dipinjam')
 <button class="btn btn-sm bg-success">Tandai Kembali</button>
 @else
 <span style="font-size: 0.8rem; color: #666;">Selesai</span>
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="7" class="text-center">Belum ada data transaksi.</td>
 </tr>
 @endforelse
 </tbody>
 </table>

 <div class="mt-3">
 {{ $transaksis->links() }}
 </div>
</div>
@endsection
