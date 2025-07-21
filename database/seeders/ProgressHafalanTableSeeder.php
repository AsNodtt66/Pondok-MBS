<?php

namespace Database\Seeders;

use App\Models\ProgressHafalan;
use App\Models\Santri;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProgressHafalanTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar surah Al-Qur'an (contoh beberapa surah, bisa diperluas)
        $surahs = [
            'Al-Fatihah', 'Al-Baqarah', 'Ali Imran', 'An-Nisa', 'Al-Maidah',
            'Al-Anam', 'Al-Araf', 'Al-Anfal', 'At-Taubah', 'Yunus',
            'Al-Kahf', 'Maryam', 'Yasin', 'Ad-Dukhan', 'Al-Fath',
            'An-Naba', 'An-Naziat', 'Abasa', 'At-Takwir', 'Al-Infitar',
        ];

        // Ambil ID dari tabel terkait
        $santriIds = Santri::pluck('id')->toArray();

        // Pastikan tabel terkait tidak kosong
        if (empty($santriIds)) {
            $this->command->error('Tabel santris kosong. Jalankan seeder untuk tabel tersebut terlebih dahulu.');
            return;
        }

        // Daftar catatan spesifik untuk hafalan
        $hafalanNotes = [
            'Pengucapan tajwid perlu diperbaiki pada ayat tertentu.',
            'Hafalan cukup baik, namun ada sedikit kekeliruan di bagian akhir.',
            'Perlu lebih banyak latihan untuk memperlancar hafalan.',
            'Konsisten dalam penguasaan, namun perhatikan ritme bacaan.',
            'Ayat awal lancar, namun bagian tengah perlu pengulangan.',
            'Hafalan sangat baik, lanjutkan dengan surah berikutnya.',
            'Ada kesalahan kecil pada makhraj huruf, perlu perhatian.',
            'Progres bagus, tapi perlu meningkatkan kecepatan hafalan.',
            'Memori hafalan kuat, perhatikan kekonsistenan pengucapan.',
            'Perlu fokus pada penghafalan ayat-ayat panjang.',
        ];

        // Buat 100 data progress hafalan
        for ($i = 1; $i <= 100; $i++) {
            $juz = $faker->numberBetween(1, 30);
            $surah = $faker->randomElement($surahs);
            $ayatStart = $faker->numberBetween(1, 10);
            $ayatEnd = $faker->numberBetween($ayatStart, $ayatStart + 10);

            ProgressHafalan::create([
                'Santri_id' => $faker->randomElement($santriIds),
                'Juz' => $juz,
                'Surah' => $surah,
                'Ayat_mulai' => $ayatStart,
                'Ayat_selesai' => $ayatEnd,
                'Tanggal_setor' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'Kualitas_hafalan' => $faker->randomElement(['Lancar', 'Kurang Lancar', 'Perlu Perbaikan']),
                'Catatan' => $faker->boolean(80) ? $faker->randomElement($hafalanNotes) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}