<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create('id_ID');

        // 👤 Admin utama
        User::create([
            'username' => 'adminlaundry',
            'nama_depan' => 'Admin',
            'nama_belakang' => 'Laundry',
            'email' => 'admin@laundrycoeciin.com',
            'password' => Hash::make('admin123'), // pastikan terenkripsi
        ]);

        // 👥 Tambahan user dummy (opsional)
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'username' => $faker->unique()->userName(),
                'nama_depan' => $faker->firstName(),
                'nama_belakang' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
