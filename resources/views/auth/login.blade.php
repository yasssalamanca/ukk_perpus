@extends('layouts.app')

@section('title', 'Login')

@section('content')
 <div class="card">
 <div class="card-header bg-primary">
 <h2>Login Perpus</h2>
 </div>
 <div class="card-body">
 <form action="{{ route('login.proses') }}" method="POST">
 @csrf
 <div class="form-group">
 <label>Email</label>
 <input type="email" name="email" class="form-control" required>
 </div>
 <div class="form-group">
 <label>Password</label>
 <input type="password" name="password" class="form-control"
required>
 </div>
 <button type="submit" class="btn bg-primary">Masuk</button>
 </form>
 <div class="text-center mt-3">
 <p>Belum punya akun? <a href="{{ route('register') }}" class="link-primary">Daftar sekarang!</a></p>
 </div>
 </div>
 </div>
@endsection
