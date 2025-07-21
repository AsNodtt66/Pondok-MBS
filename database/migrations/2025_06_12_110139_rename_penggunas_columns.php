<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePenggunasColumns extends Migration
{
    public function up()
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->renameColumn('Nama_pengguna', 'nama_pengguna');
            $table->renameColumn('Username', 'username');
            $table->renameColumn('Password', 'password');
            $table->renameColumn('Role_id', 'role_id');
            $table->renameColumn('Status', 'status');
        });
    }

    public function down()
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->renameColumn('nama_pengguna', 'Nama_pengguna');
            $table->renameColumn('username', 'Username');
            $table->renameColumn('password', 'Password');
            $table->renameColumn('role_id', 'Role_id');
            $table->renameColumn('status', 'Status');
        });
    }
}