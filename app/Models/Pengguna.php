<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Santri;
use App\Models\Laporan;
use App\Models\Pengurus;
use App\Models\Notifikasi;
use App\Models\ProgressHafalan;
use App\Models\PsikologiSantri;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    protected $table = 'penggunas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nama_pengguna',
        'username',
        'password',
        'role_id',
        'status',
        'santri_id', // Tambahkan jika digunakan
        'wali_id',   // Tambahkan jika digunakan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi dengan Role (One-to-One)
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relasi dengan Pengurus (One-to-One atau One-to-Many)
    public function pengurus()
    {
        return $this->hasOne(Pengurus::class, 'Pengguna_id');
    }

    // Relasi dengan Notifikasi (One-to-Many)
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'Pengguna_id');
    }

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    // Relasi ke PsikologiSantri
    public function psikologiSantris()
    {
        return $this->hasMany(PsikologiSantri::class, 'Santri_id');
    }

    // Relasi ke ProgressHafalan
    public function progressHafalans()
    {
        return $this->hasMany(ProgressHafalan::class, 'Santri_id');
    }

    // Relasi dengan Laporan (One-to-Many)
    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'Pembuat_id');
    }

    // Tambahkan helper isSantri, isWali, isPengurus jika belum ada di model User
    public function isSantri(): bool
    {
        return $this->Role_id === Role::SANTRI;
    }

    public function isWali(): bool
    {
        return $this->Role_id === Role::WALI;
    }

    public function isPengurus(): bool
    {
        return $this->Role_id === Role::PENGURUS;
    }

    public function isAdmin(): bool
    {
        return $this->Role_id === Role::ADMIN;
    }
}