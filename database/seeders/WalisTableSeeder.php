<?php

namespace Database\Seeders;

use App\Models\Wali;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class WalisTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            Wali::create([
                'Nama_wali' => $faker->name,
                'Alamat_wali' => 'Jawa Timur, ' . $faker->city,
                'Kontak' => $faker->phoneNumber,
                'Email_wali' => $faker->unique()->safeEmail,
                'Hubungan' => $faker->randomElement(['Ayah', 'Ibu', 'Wali']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}