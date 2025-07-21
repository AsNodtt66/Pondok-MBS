<?php

namespace App\Models;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'penguruses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Pengguna_id', 'Jabatan', 'Tanggal_jabatan'
    ];

    // Relasi dengan Pengguna (One-to-One)
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'Pengguna_id');
    }
}