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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('Jenis_laporan');
            $table->date('Tanggal_generate');
            $table->date('Tanggal_lapor')->nullable();
            $table->unsignedBigInteger('Santri_id');
            $table->unsignedBigInteger('Psikologi_santri_id')->nullable();
            $table->unsignedBigInteger('Pembayaran_id')->nullable();
            $table->unsignedBigInteger('Progress_hafalan_id')->nullable();
            $table->timestamps();

            $table->foreign('Santri_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->foreign('Psikologi_santri_id')->references('id')->on('psikologi_santris')->onDelete('set null');
            $table->foreign('Pembayaran_id')->references('id')->on('pembayarans')->onDelete('set null');
            $table->foreign('Progress_hafalan_id')->references('id')->on('progress_hafalan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};