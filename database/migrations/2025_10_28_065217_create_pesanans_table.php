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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_user')->constrained('users');
            $table->string('nama_pelanggan', 100);
            $table->string('nomor_telephone', 20)->nullable();
            $table->decimal('berat_cucian', 5, 2);
            $table->enum('jenis_layanan', ['Regular', 'Express', 'Super Express/Kilat']);
            $table->dateTime('tanggal_pesanan');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status_pesanan', ['Belum', 'Dikerjakan', 'Selesai'])->default('Belum');
            $table->decimal('total_harga', 10, 2)->nullable();
            $table->enum('metode_pembayaran', ['Tunai', 'Qris'])->nullable();
            $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
