<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //    $this->call([
    //         UserSeeder::class,
    //         PesananSeeder::class,
    //         PengeluaranSeeder::class,
    //     ]);
    // }
    public function run(): void
    {
        // Nonaktifkan sementara pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua data tabel terkait
        DB::table('pesanans')->truncate();
        DB::table('pengeluarans')->truncate();
        DB::table('users')->truncate();

        // Aktifkan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Jalankan seeder masing-masing
        $this->call([
            UserSeeder::class,
            PesananSeeder::class,
            PengeluaranSeeder::class,
        ]);
    }
}
