<?php

namespace App\Models;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Role constants for easy reference
    const ADMIN = 1;
    const PENGURUS = 2;
    const SANTRI = 3;
    const WALI = 4;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Nama_role', 
        'Hak_akses', 
        'Jenis_role'
    ];

    protected $casts = [
        'Hak_akses' => 'array' // If Hak_akses is stored as JSON
    ];

    // Relationship with Pengguna (One-to-Many)
    public function penggunas()
    {
        return $this->hasMany(Pengguna::class, 'role_id');
    }

    // Helper method to check role type
    public function isAdmin(): bool
    {
        return $this->id === self::ADMIN;
    }

    public function isPengurus(): bool
    {
        return $this->id === self::PENGURUS;
    }

    public function isSantri(): bool
    {
        return $this->id === self::SANTRI;
    }

    public function isWali(): bool
    {
        return $this->id === self::WALI;
    }
}