<?php

namespace App\Models;

use App\Models\Alumni;
use App\Models\Santri;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    protected $table = 'walis';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Nama_wali', 'Alamat_wali', 'Kontak', 'Email_wali', 'Hubungan'
    ];

    protected $rules = [
        'Kontak' => 'required|regex:/^(\+62|0)[0-9]{9,12}$/',
        'Email_wali' => 'required|email',
    ];

    // Relasi dengan Santri (One-to-One atau One-to-Many, asumsi One-to-Many)
    public function santris()
    {
        return $this->hasMany(Santri::class, 'wali_id');
    }

    // Relasi dengan Alumni (One-to-Many)
    public function alumnis()
    {
        return $this->hasMany(Alumni::class, 'wali_id');
    }
}