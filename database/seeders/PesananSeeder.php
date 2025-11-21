<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\HargaLayanan;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $faker = Faker::create('id_ID');

        // Ambil semua layanan
        $layananList = HargaLayanan::all();

        for ($i = 0; $i < 10; $i++) {

            // Pilih layanan secara acak
            $layanan = $layananList->random();

            $berat = $faker->randomFloat(2, 1, 10);
            $totalHarga = $berat * $layanan->harga_per_kg;

            // tanggal pesanan antara 1–14 hari lalu
            $tanggalPesanan = Carbon::now()->subDays(rand(1, 14));

            // Status pesanan
            $statusPesanan = $faker->randomElement(['Pending', 'Proses', 'Selesai']);
            $tanggalSelesai = $statusPesanan === 'Selesai'
                ? (clone $tanggalPesanan)->addDays(rand(1, 3))
                : null;

            // Status pembayaran
            $statusPembayaran = match ($statusPesanan) {
                'Pending' => $faker->boolean(20) ? 'Lunas' : 'Belum Lunas',
                'Proses' => $faker->boolean(50) ? 'Lunas' : 'Belum Lunas',
                'Selesai' => $faker->boolean(80) ? 'Lunas' : 'Belum Lunas',
            };

            $metodePembayaran = $statusPembayaran === 'Lunas'
                ? $faker->randomElement(['Cash', 'Transfer', 'E-wallet'])
                : null;

            $tanggalPembayaran = $statusPembayaran === 'Lunas'
                ? $faker->dateTimeBetween('-1 week', 'now')
                : null;

            // Simpan ke database
            Pesanan::create([
                'id_user' => $user->id,
                'nama_pelanggan' => $faker->name(),
                'nomor_telephone' => $faker->numerify('08##########'),
                'barang_laundry' => $faker->randomElement(['pakaian', 'sepatu', 'celana']),
                'berat_cucian' => $berat,
                'id_layanan' => $layanan->id_layanan, // FK benar
                'tanggal_pesanan' => $tanggalPesanan,
                'tanggal_selesai' => $tanggalSelesai,
                'keterangan' => $faker->sentence(),
                'status_pesanan' => $statusPesanan,
                'total_harga' => $totalHarga,
                'metode_pembayaran' => $metodePembayaran,
                'status_pembayaran' => $statusPembayaran,
                'tanggal_pembayaran' => $tanggalPembayaran,
            ]);
        }
    }
}