<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\PsikologiSantri;
use App\Models\Santri;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PsikologiSantrisTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID dari tabel terkait
        $santriIds = Santri::pluck('id')->toArray();

        // Pastikan tabel terkait tidak kosong
        if (empty($santriIds)) {
            $this->command->error('Tabel santris kosong. Jalankan seeder untuk tabel tersebut terlebih dahulu.');
            return;
        }

        // Daftar sifat psikologis santri
        $sifatPsikologi = [
            'Rajin' => 'Santri ini menunjukkan sikap rajin dalam belajar dan ibadah.',
            'Pemalas' => 'Santri ini cenderung malas dalam melaksanakan tugas dan ibadah.',
            'Nakal' => 'Santri ini memiliki sikap nakal yang sering mengganggu teman.',
            'Jahil' => 'Santri ini sering bercanda atau berbuat jahil terhadap teman sebayanya.',
            'Displin' => 'Santri ini sangat disiplin dalam mengikuti aturan pondok.',
            'Malas Ibadah' => 'Santri ini kurang konsisten dalam menjalankan ibadah wajib.',
            'Sosial' => 'Santri ini aktif dan mudah bergaul dengan teman-temannya.',
            'Introvert' => 'Santri ini cenderung pendiam dan lebih suka menyendiri.',
        ];

        // Daftar saran/pujian/kritik dari guru
        $catatanOptions = [
            'Pujian' => [
                'Bagus, terus pertahankan kebiasaan rajinnya.',
                'Keren, disiplinmu patut dicontoh oleh santri lain.',
                'Sosialitasmu membantu menciptakan suasana harmonis, lanjutkan!',
                'Kedisiplinanmu sangat baik, jadilah teladan.',
            ],
            'Saran' => [
                'Cobalah lebih aktif dalam kegiatan pondok.',
                'Perbanyak waktu untuk ibadah agar lebih baik.',
                'Usahakan untuk lebih terbuka dengan teman-teman.',
                'Latihan hafalan lebih giat untuk meningkatkan prestasi.',
            ],
            'Kritik' => [
                'Perbaiki sikap nakalmu agar lebih disiplin.',
                'Hentikan kebiasaan jahil yang mengganggu teman.',
                'Kebiasaan malasmu perlu segera diperbaiki.',
                'Kurangi sikap introvert dan lebih berpartisipasi.',
            ],
        ];

        // Buat 100 data psikologi santri
        for ($i = 1; $i <= 100; $i++) {
            $sifatKey = array_rand($sifatPsikologi);
            $catatanType = array_rand($catatanOptions);

            PsikologiSantri::create([
                'Santri_id' => $faker->randomElement($santriIds),
                'Tanggal_konseling' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'Hasil_psikologi' => $sifatPsikologi[$sifatKey],
                'Catatan' => $faker->randomElement($catatanOptions[$catatanType]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}