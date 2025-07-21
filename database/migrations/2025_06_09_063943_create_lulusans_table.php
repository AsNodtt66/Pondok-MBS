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
        Schema::create('lulusans', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('Alumni_id');
            $table->date('Tanggal_lulus');
            $table->string('Niai_akhir');
            $table->string('Predikat');
            $table->timestamps();

            $table->foreign('Alumni_id')->references('id')->on('alumnis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lulusans');
    }
};