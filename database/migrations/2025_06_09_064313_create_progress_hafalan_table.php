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
        Schema::create('progress_hafalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Santri_id');
            $table->integer('Juz')->between(1, 30);
            $table->string('Surah');
            $table->string('Ayat_mulai'); // Contoh: "1-5" atau "1"
            $table->string('Ayat_selesai'); // Contoh: "1-5" atau "1"
            $table->date('Tanggal_setor');
            $table->enum('Kualitas_hafalan', ['Lancar', 'Kurang Lancar', 'Perlu Perbaikan']);
            $table->text('Catatan')->nullable();
            $table->timestamps();

            $table->foreign('Santri_id')->references('id')->on('santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_hafalan');
    }
};