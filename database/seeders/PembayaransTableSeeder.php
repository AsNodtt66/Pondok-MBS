<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Santri;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PembayaransTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $santriIds = Santri::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            Pembayaran::create([
                'Santri_id' => $faker->randomElement($santriIds),
                'Jenis_pembayaran' => $faker->randomElement(['SPP', 'Uang Gedung', 'Seragam']),
                'Jumlah' => $faker->randomNumber(6),
                'Tanggal_bayar' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'Metode_bayar' => $faker->randomElement(['transfer', 'tunai']),
                'Status_bayar' => $faker->randomElement(['Lunas', 'Belum']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}