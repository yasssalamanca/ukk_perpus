<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->nullable()->unique(); // Tambahan baru
            $table->string('name');
            $table->string('kelas')->nullable(); // Tambahan baru
            $table->string('email')->unique(); // Anggap aja email tetep dipake buat login/notifikasi
            $table->string('password');
            $table->enum('role', ['pustakawan', 'anggota'])->default('anggota');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
