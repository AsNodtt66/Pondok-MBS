<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder untuk tabel roles
        $this->call(RolesTableSeeder::class);

        // Panggil seeder untuk tabel walis
        $this->call(WalisTableSeeder::class);

        // Panggil seeder untuk tabel santris
        $this->call(SantrisTableSeeder::class);

        // Panggil seeder untuk tabel penggunas
        $this->call(PenggunasTableSeeder::class);

        // Panggil seeder untuk tabel alumnis
        $this->call(AlumnisTableSeeder::class);

        // Panggil seeder untuk tabel lulusans
        $this->call(LulusansTableSeeder::class);

        // Panggil seeder untuk tabel pembayarans
        $this->call(PembayaransTableSeeder::class);

        // Panggil seeder untuk tabel progress_hafalan
        $this->call(ProgressHafalanTableSeeder::class);

        // Panggil seeder untuk tabel psikologi_santris
        $this->call(PsikologiSantrisTableSeeder::class);

        // Panggil seeder untuk tabel laporans
        $this->call(LaporansTableSeeder::class);
    }
}