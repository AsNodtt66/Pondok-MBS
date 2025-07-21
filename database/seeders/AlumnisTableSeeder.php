<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\Wali;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AlumnisTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $waliIds = Wali::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            Alumni::create([
                'Nama_alumni' => $faker->name . ' ' . $faker->randomElement(['S.T.', 'S.Psi', 'S.H.', 'M.Pd', '']),
                'Santri_id' => 'ALM' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'Tanggal_lhr' => $faker->dateTimeBetween('-30 years', '-20 years')->format('Y-m-d'),
                'Jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'Status_aksk' => 'nonaktif',
                'Email' => $faker->unique()->safeEmail,
                'No_hp' => $faker->phoneNumber,
                'Wali_id' => $faker->randomElement($waliIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}