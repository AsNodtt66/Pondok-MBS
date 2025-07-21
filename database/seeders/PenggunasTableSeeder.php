<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Role;
use App\Models\Santri;
use App\Models\Wali;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PenggunasTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $roleIds = Role::pluck('id')->toArray();

        // Ambil data santri dan wali yang sudah ada
        $santris = Santri::all();
        $walis = Wali::all();

        // Buat pengguna untuk setiap santri (role_id = 3)
        foreach ($santris as $index => $santri) {
            $namaDepan = explode(' ', $santri->Nama_santri)[0]; // Ambil nama depan
            $username = strtolower($namaDepan) . '_' . ($index + 1);
            Pengguna::create([
                'nama_pengguna' => $santri->Nama_santri,
                'username' => $username,
                'password' => bcrypt('password'), // Kata sandi default
                'role_id' => 3, // Santri
                'santri_id' => $santri->id,
                'wali_id' => $santri->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Buat pengguna untuk setiap wali (role_id = 4)
        foreach ($walis as $index => $wali) {
            $namaDepan = explode(' ', $wali->Nama_wali)[0]; // Ambil nama depan
            $username = strtolower($namaDepan) . '_' . ($index + 1);
            Pengguna::create([
                'nama_pengguna' => $wali->Nama_wali,
                'username' => $username,
                'password' => bcrypt('password'), // Kata sandi default
                'role_id' => 4, // Wali
                'santri_id' => $wali->id,
                'wali_id' => $wali->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tambahkan pengguna tambahan untuk admin/pengurus jika diperlukan
        for ($i = 1; $i <= 10; $i++) {
            $namaPengguna = $faker->name;
            $namaDepan = explode(' ', $namaPengguna)[0]; // Ambil nama depan
            $username = strtolower($namaDepan) . '_' . $i;
            Pengguna::create([
                'nama_pengguna' => $namaPengguna,
                'username' => $username,
                'password' => bcrypt('password'),
                'role_id' => $faker->randomElement([1, 2]), // Admin atau Pengurus
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}