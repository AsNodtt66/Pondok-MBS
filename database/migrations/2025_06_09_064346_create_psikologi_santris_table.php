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
        Schema::create('psikologi_santris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Santri_id');
            $table->date('Tanggal_konseling');
            $table->text('Hasil_psikologi');
            $table->text('Catatan');
            $table->timestamps();

            $table->foreign('Santri_id')->references('id')->on('santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psikologi_santris');
    }
};