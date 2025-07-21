<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'Nama_role' => 'Admin',
                'Hak_akses' => 'full',
                'Jenis_role' => 'admin',
            ],
            [
                'Nama_role' => 'Guru',
                'Hak_akses' => 'limited',
                'Jenis_role' => 'pengurus',
            ],
            [
                'Nama_role' => 'Santri',
                'Hak_akses' => 'read_only',
                'Jenis_role' => 'santri',
            ],
            [
                'Nama_role' => 'Wali Santri',
                'Hak_akses' => 'read_only',
                'Jenis_role' => 'wali',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}