<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('harga_layanans', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->string('jenis_layanan')->unique();
            $table->integer('harga_per_kg');
            $table->timestamps();
        });

        // Insert default layanan
        DB::table('harga_layanans')->insert([
            ['jenis_layanan' => 'Satuan', 'harga_per_kg' => 10000],
            ['jenis_layanan' => 'Regular', 'harga_per_kg' => 7000],
            ['jenis_layanan' => 'Express', 'harga_per_kg' => 10000],
            ['jenis_layanan' => 'Super Express/Kilat', 'harga_per_kg' => 12000],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_layanans');
    }
};
