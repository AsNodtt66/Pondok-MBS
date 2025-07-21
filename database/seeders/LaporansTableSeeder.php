<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Pembayaran;
use App\Models\Pengguna;
use App\Models\ProgressHafalan;
use App\Models\PsikologiSantri;
use App\Models\Santri;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LaporansTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID dari tabel terkait
        $santriIds = Santri::pluck('id')->toArray();
        $pembayaranIds = Pembayaran::pluck('id')->toArray();
        $psikologiSantriIds = PsikologiSantri::pluck('id')->toArray();
        $progressHafalanIds = ProgressHafalan::pluck('id')->toArray();

        // Pastikan tabel terkait tidak kosong
        if (empty($santriIds) || empty($pembayaranIds) || empty($psikologiSantriIds) || empty($progressHafalanIds)) {
            $this->command->error('Tabel santris, pembayarans, psikologi_santris, atau progress_hafalan kosong. Jalankan seeder untuk tabel tersebut terlebih dahulu.');
            return;
        }

        // Buat 100 data laporan
        for ($i = 1; $i <= 100; $i++) {
            // Pilih Santri_id secara acak
            $santriId = $faker->randomElement($santriIds);

            // Filter ID relasi berdasarkan Santri_id untuk konsistensi
            $filteredPembayaranIds = Pembayaran::where('Santri_id', $santriId)->pluck('id')->toArray();
            $filteredPsikologiSantriIds = PsikologiSantri::where('Santri_id', $santriId)->pluck('id')->toArray();
            $filteredProgressHafalanIds = ProgressHafalan::where('Santri_id', $santriId)->pluck('id')->toArray();

            // Tentukan apakah laporan akan memiliki semua ID terisi (90% kemungkinan)
            $isFullRelation = $faker->boolean(90); // 90% laporan memiliki semua ID

            // Inisialisasi ID relasi
            $pembayaranId = null;
            $psikologiSantriId = null;
            $progressHafalanId = null;

            if ($isFullRelation && !empty($filteredPembayaranIds) && !empty($filteredPsikologiSantriIds) && !empty($filteredProgressHafalanIds)) {
                // Isi semua ID relasi
                $pembayaranId = $faker->randomElement($filteredPembayaranIds);
                $psikologiSantriId = $faker->randomElement($filteredPsikologiSantriIds);
                $progressHafalanId = $faker->randomElement($filteredProgressHafalanIds);
                $jenisLaporan = 'Kombinasi'; // Jenis laporan untuk semua relasi
            } else {
                // Untuk 10% sisanya, isi 1-2 relasi secara acak
                $jenisLaporan = $faker->randomElement(['Pembayaran', 'Psikologi', 'Hafalan']);
                switch ($jenisLaporan) {
                    case 'Pembayaran':
                        if (!empty($filteredPembayaranIds)) {
                            $pembayaranId = $faker->randomElement($filteredPembayaranIds);
                        }
                        // 50% kemungkinan menambah satu relasi lain
                        if ($faker->boolean(50) && !empty($filteredPsikologiSantriIds)) {
                            $psikologiSantriId = $faker->randomElement($filteredPsikologiSantriIds);
                        } elseif ($faker->boolean(50) && !empty($filteredProgressHafalanIds)) {
                            $progressHafalanId = $faker->randomElement($filteredProgressHafalanIds);
                        }
                        break;
                    case 'Psikologi':
                        if (!empty($filteredPsikologiSantriIds)) {
                            $psikologiSantriId = $faker->randomElement($filteredPsikologiSantriIds);
                        }
                        if ($faker->boolean(50) && !empty($filteredPembayaranIds)) {
                            $pembayaranId = $faker->randomElement($filteredPembayaranIds);
                        } elseif ($faker->boolean(50) && !empty($filteredProgressHafalanIds)) {
                            $progressHafalanId = $faker->randomElement($filteredProgressHafalanIds);
                        }
                        break;
                    case 'Hafalan':
                        if (!empty($filteredProgressHafalanIds)) {
                            $progressHafalanId = $faker->randomElement($filteredProgressHafalanIds);
                        }
                        if ($faker->boolean(50) && !empty($filteredPembayaranIds)) {
                            $pembayaranId = $faker->randomElement($filteredPembayaranIds);
                        } elseif ($faker->boolean(50) && !empty($filteredPsikologiSantriIds)) {
                            $psikologiSantriId = $faker->randomElement($filteredPsikologiSantriIds);
                        }
                        break;
                }
            }

            Laporan::create([
                'Jenis_laporan' => $jenisLaporan,
                'Tanggal_generate' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'Tanggal_lapor' => $faker->boolean(70) ? $faker->dateTimeThisYear()->format('Y-m-d') : null,
                'Santri_id' => $santriId,
                'Psikologi_santri_id' => $psikologiSantriId,
                'Pembayaran_id' => $pembayaranId,
                'Progress_hafalan_id' => $progressHafalanId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}