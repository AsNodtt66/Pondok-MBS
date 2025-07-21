<?php

namespace Database\Seeders;

use App\Models\Santri;
use App\Models\Wali;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SantrisTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $waliIds = Wali::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            Santri::create([
                'Nama_santri' => $faker->name,
                'Santri_id' => 'SNT' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'Tanggal_lhr' => $faker->dateTimeBetween('-18 years', '-10 years')->format('Y-m-d'),
                'Jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'Status_aksk' => $faker->randomElement(['aktif', 'nonaktif']),
                'Email' => $faker->unique()->safeEmail,
                'No_hp' => $faker->phoneNumber,
                'Wali_id' => $i, // Sesuaikan dengan ID wali
                'Kelas' => $faker->randomElement([1, 2, 3, 4, 5, 6]),
                'tempat_lahir' => $faker->city, // Data dummy untuk tempat lahir
                'alamat' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}