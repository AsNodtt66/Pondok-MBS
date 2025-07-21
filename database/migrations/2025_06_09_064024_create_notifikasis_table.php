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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Pengguna_id');
            $table->string('Jenis_notifikasi');
            $table->enum('Pesan', ['kirim', 'terima']);
            $table->date('Tanggal_kirim');
            $table->enum('Status', ['terbaca', 'belum']);
            $table->timestamps();

            $table->foreign('Pengguna_id')->references('id')->on('penggunas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};