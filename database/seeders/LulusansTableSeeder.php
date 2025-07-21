<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\Lulusan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LulusansTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $alumniIds = Alumni::pluck('id')->toArray();

        foreach ($alumniIds as $alumniId) {
            Lulusan::create([
                'Alumni_id' => $alumniId,
                'Tanggal_lulus' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'Niai_akhir' => $faker->randomFloat(2, 80, 100),
                'Predikat' => $faker->randomElement(['Cum Laude', 'Sangat Baik', 'Baik', 'Cukup']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}