<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus UKK - @yield('title', 'Aplikasi')</title>
    <style>
        /* Reset Dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        .navbar {
            background-color: #0d6efd;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-nav {
            background-color: white;
            color: #0d6efd;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid white;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Container Utama */
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
        }

        /* Komponen Card (Buat Form) */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 400px;
            margin: 0 auto;
        }

        .card-header {
            padding: 20px;
            text-align: center;
            color: white;
        }

        .bg-primary {
            background-color: #0d6efd;
        }

        .bg-success {
            background-color: #198754;
        }

        .card-body {
            padding: 25px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            transition: border 0.3s;
        }

        .form-control:focus {
            border-color: #0d6efd;
        }

        /* Buttons */
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Teks & Bantuan */
        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 15px;
        }

        .link-primary {
            color: #0d6efd;
            font-weight: bold;
        }

        .link-success {
            color: #198754;
            font-weight: bold;
        }

        /* Flash Messages (Alert) */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .alert ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        /* Styles untuk Table */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Utilities */
        .d-flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .align-center {
            align-items: center;
        }

        .gap-2 {
            gap: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        /* Tombol Aksi */
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-success {
            background-color: #198754;
            color: white;
        }

        .btn-info {
            background-color: #0dcaf0;
            color: #000;
        }

        /* Form Pencarian */
        .search-form {
            display: flex;
            gap: 10px;
            max-width: 400px;
        }

        .search-form .form-control {
            width: 70%;
        }

        .search-form .btn {
            width: 30%;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand">Perpus UKK</div>
        <div class="nav-links">
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class="btn-nav">Daftar</a>
            @else
                @if (Auth::user()->role === 'pustakawan')
                    <a href="{{ route('pustakawan.dashboard') }}">Dashboard</a>
                    <a href="{{ route('pustakawan.buku') }}">Data Buku</a>
                    <a href="{{ route('pustakawan.anggota') }}">Data Anggota</a>
                    <a href="{{ route('pustakawan.transaksi') }}">Transaksi</a>
                @endif

                @if (Auth::user()->role === 'anggota')
                    <a href="{{ route('anggota.dashboard') }}">Dashboard</a>
                    <a href="{{ route('anggota.pinjam') }}">Pinjam Buku</a>
                    <a href="{{ route('anggota.kembali') }}">Buku Saya</a>
                @endif

                <span>Halo, <b>{{ Auth::user()->name }}</b> ({{ Auth::user()->role }})</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                Peringatan:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>
