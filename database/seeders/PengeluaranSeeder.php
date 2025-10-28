<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\Pengeluaran; 
use App\Models\User;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create(); // Ganti dengan ID yg ada kalo ga dummy

        $faker = Faker::create('id_ID');

        // Ubah angka 20 jika ingin jumlah data dummy lebih banyak
        for ($i = 1; $i <= 10; $i++) {

            // Pilih kategori acak
            $kategori = $faker->randomElement([
                'Deterjen & Sabun',
                'Pewangi & Pelicin',
                'Pemutih & Pewarna',
                'Plastik & Kemasan',
                'Alat Pendukung Cuci & Setrika',
                'Lain-lain'
            ]);

            // Nominal acak sesuai kategori
            $nominal = match ($kategori) {
                'Deterjen & Sabun' => $faker->randomFloat(2, 20000, 80000),
                'Pewangi & Pelicin' => $faker->randomFloat(2, 15000, 60000),
                'Pemutih & Pewarna' => $faker->randomFloat(2, 10000, 50000),
                'Plastik & Kemasan' => $faker->randomFloat(2, 5000, 30000),
                'Alat Pendukung Cuci & Setrika' => $faker->randomFloat(2, 30000, 120000),
                default => $faker->randomFloat(2, 10000, 70000),
            };

            // Metode pembayaran acak
            $metodePembayaran = $faker->randomElement(['Tunai', 'Qris']);

            // Buat tanggal acak dalam 30 hari terakhir
            $tanggal = Carbon::now()->subDays(rand(0, 30));

            // Buat deskripsi atau keterangan acak
            $keterangan = match ($kategori) {
                'Deterjen & Sabun' => 'Pembelian deterjen cair dan sabun cuci',
                'Pewangi & Pelicin' => 'Beli pewangi pakaian dan pelicin setrika',
                'Pemutih & Pewarna' => 'Beli pemutih pakaian dan pewarna tambahan',
                'Plastik & Kemasan' => 'Beli plastik laundry ukuran besar dan sedang',
                'Alat Pendukung Cuci & Setrika' => 'Beli alat pel, sikat, dan kain setrika baru',
                default => 'Pengeluaran operasional harian lainnya',
            };

            // Simpan ke database via model
            Pengeluaran::create([
                'id_user' => $user -> id, 
                'nominal' => $nominal,
                'kategori' => $kategori,
                'metode_pembayaran' => $metodePembayaran,
                'penerima' => $faker->name(),
                'keterangan' => $keterangan,
                'tanggal' => $tanggal,
                'bukti_pengeluaran' => null,
            ]);
        }
    }
}
