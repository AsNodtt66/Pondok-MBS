<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->unsignedBigInteger('santri_id')->nullable()->after('role_id');
            $table->unsignedBigInteger('wali_id')->nullable()->after('santri_id');

            $table->foreign('santri_id')->references('id')->on('santris')->onDelete('set null');
            $table->foreign('wali_id')->references('id')->on('walis')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->dropForeign(['santri_id']);
            $table->dropForeign(['wali_id']);
            $table->dropColumn(['santri_id', 'wali_id']);
        });
    }
};