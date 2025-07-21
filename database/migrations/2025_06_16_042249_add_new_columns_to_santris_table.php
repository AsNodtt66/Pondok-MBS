<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable(); // Kolom baru untuk tempat lahir
            $table->text('alamat')->nullable();         // Kolom baru untuk alamat
        });
    }

    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'alamat']); // Rollback jika migration dibatalkan
        });
    }
};