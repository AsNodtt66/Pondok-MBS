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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Santri_id');
            $table->string('Jenis_pembayaran');
            $table->decimal('Jumlah', 10, 2);
            $table->date('Tanggal_bayar');
            $table->enum('Metode_bayar', ['transfer', 'tunai']);
            $table->enum('Status_bayar', ['lunas', 'belum']);
            $table->date('Jatuh_tempo')->nullable();
            $table->timestamps();

            $table->foreign('Santri_id')->references('id')->on('santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};