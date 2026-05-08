<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bikin Akun Pustakawan (Admin)
        User::create([
            'nis' => null, // Pustakawan nggak punya NIS
            'name' => 'Admin Pustakawan',
            'kelas' => null, // Pustakawan nggak punya kelas
            'email' => 'admin@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'pustakawan'
        ]);

        // 2. Bikin Akun Anggota (Siswa)
        User::create([
            'nis' => '12345678', // Anggota punya NIS
            'name' => 'Siswa Anggota',
            'kelas' => '12 RPL 2', // Anggota punya kelas
            'email' => 'siswa@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'anggota'
        ]);

        // (Opsional) Lu bisa tambahin lagi akun lain di bawahnya kalau perlu
    }
}
