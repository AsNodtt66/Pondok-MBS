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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_alumni');
            $table->string('Santri_id');
            $table->date('Tanggal_lhr');
            $table->string('Jenis_kelamin');
            $table->enum('Status_aksk', ['aktif', 'nonaktif']);
            $table->string('Email');
            $table->string('No_hp');
            $table->unsignedBigInteger('Wali_id')->nullable();
            $table->timestamps();

            $table->foreign('Wali_id')->references('id')->on('walis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};