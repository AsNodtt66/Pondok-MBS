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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_pengguna');
            $table->string('Username');
            $table->string('Password');
            $table->unsignedBigInteger('Role_id');
            $table->enum('Status', ['aktif', 'nonaktif']);
            $table->timestamps();

            $table->foreign('Role_id')->references('id')->on('roles')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};