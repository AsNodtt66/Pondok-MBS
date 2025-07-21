<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('progress_hafalan', function (Blueprint $table) {
            // Menambahkan kolom Status_setor
            // Sesuaikan tipe data dan batasan jika diperlukan.
            // Dari controller, terlihat ini adalah string 'lulus' atau 'belum lulus'.
            $table->string('Status_setor')->after('Tanggal_setor')->nullable(); // Menambahkan setelah Tanggal_setor
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_hafalan', function (Blueprint $table) {
            // Menghapus kolom Status_setor jika migrasi di-rollback
            $table->dropColumn('Status_setor');
        });
    }
};