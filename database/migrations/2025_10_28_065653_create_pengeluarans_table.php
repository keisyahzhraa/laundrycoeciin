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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id('id_pengeluaran');
            $table->foreignId('id_user')->constrained('users');
            $table->decimal('nominal', 10, 2);
            $table->enum('kategori', [
                'Deterjen & Sabun',
                'Pewangi & Pelicin',
                'Pemutih & Pewarna',
                'Plastik & Kemasan',
                'Alat Pendukung Cuci & Setrika',
                'Lain-lain'
            ]);
            $table->enum('metode_pembayaran', ['Tunai', 'Qris']);
            $table->string('penerima', 100);
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal');
            $table->longText('bukti_pengeluaran')->nullable(); // menyimpan gambar sebagai base64
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
