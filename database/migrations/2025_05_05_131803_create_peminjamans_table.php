<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();

            // Relasi ke user dan barang
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');

            // Informasi peminjam
            $table->string('kelas_peminjam');
            $table->text('keterangan')->nullable();

            // Detail pinjam
            $table->integer('jumlah');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_pengembalian');

            // Status: menunggu, disetujui, ditolak, dikembalikan
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'dikembalikan'])->default('menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
