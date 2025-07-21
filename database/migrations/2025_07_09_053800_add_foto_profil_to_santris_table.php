<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoProfilToSantrisTable extends Migration
{
    public function up()
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->string('foto_profil')->nullable()->after('alamat');
        });
    }

    public function down()
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn('foto_profil');
        });
    }
}