<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HargaLayanan;

class HargaLayananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['jenis_layanan' => 'Satuan', 'harga_per_kg' => 5000],
            ['jenis_layanan' => 'Regular', 'harga_per_kg' => 8000],
            ['jenis_layanan' => 'Express', 'harga_per_kg' => 12000],
            ['jenis_layanan' => 'Super Express/Kilat', 'harga_per_kg' => 15000],
        ];

        foreach ($data as $item) {
            HargaLayanan::updateOrCreate(
                ['jenis_layanan' => $item['jenis_layanan']],
                ['harga_per_kg' => $item['harga_per_kg']]
            );
        }
    }
}

