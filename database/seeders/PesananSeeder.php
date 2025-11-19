<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\Pesanan;
use App\Models\User;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create(); // Ganti dengan ID yg ada kalo ga dummy

         $faker = Faker::create('id_ID'); // gunakan locale Indonesia

        // Generate 10 data contoh pesanan
        for ($i = 0; $i < 10; $i++) {
            // tanggal pesanan antara 1–7 hari lalu
            $tanggalPesanan = Carbon::now()->subDays(rand(1, 14));

            // status pesanan (acak)
            $statusPesanan = $faker->randomElement(['Pending', 'Proses', 'Selesai']);
            $tanggalSelesai = $statusPesanan === 'Selesai'
                ? (clone $tanggalPesanan)->addDays(rand(1, 3))
                : null;

           // 💰 Status pembayaran (lebih fleksibel)
            $statusPembayaran = match ($statusPesanan) {
                'Pending' => $faker->boolean(20) ? 'Lunas' : 'Belum Lunas',
                'Proses' => $faker->boolean(50) ? 'Lunas' : 'Belum Lunas',
                'Selesai' => $faker->boolean(80) ? 'Lunas' : 'Belum Lunas',
                default => 'Belum Lunas',
            };

            $metodePembayaran = $statusPembayaran === 'Lunas'
                ? $faker->randomElement(['Cash', 'Transfer', 'E-wallet'])
                : null;

            $tanggalPembayaran = $statusPembayaran === 'Lunas'
                ? $faker->dateTimeBetween('-1 week', 'now')
                : null;

            // Jenis layanan dan berat
            $jenisLayanan = $faker->randomElement(['Satuan', 'Regular', 'Express', 'Super Express/Kilat']);
            $berat = $faker->randomFloat(2, 1, 10); // 1–10 kg

            // harga berdasarkan jenis layanan (contoh logika sederhana)
            $hargaPerKg = match ($jenisLayanan) {
                'Regular' => 7000,
                'Express' => 10000,
                'Super Express/Kilat' => 15000,
                default => 7000,
            };
            $totalHarga = $berat * $hargaPerKg;

             // 🧾 Simpan ke database lewat model
            Pesanan::create([
                'id_user' => $user -> id, // bisa diganti dengan ID user admin
                'nama_pelanggan' => $faker->name(),
                'nomor_telephone' => $faker->numerify('08##########'),
                'berat_cucian' => $berat,
                'jenis_layanan' => $jenisLayanan,
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
