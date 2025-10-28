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
            'name' => 'Admin Laundry',
            'email' => 'admin@laundrycoeciin.com',
            'password' => Hash::make('admin123'), // pastikan terenkripsi
        ]);

        // 👥 Tambahan user dummy (opsional)
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
