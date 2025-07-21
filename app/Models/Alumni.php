<?php

namespace App\Models;

use App\Models\Wali;
use App\Models\Lulusan;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnis';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Nama_alumni', 'Santri_id', 'Tanggal_lhr', 'Jenis_kelamin', 'Status_aksk',
        'Email', 'No_hp', 'Wali_id'
    ];

    // Relasi dengan Wali (One-to-One)
    public function wali()
    {
        return $this->belongsTo(Wali::class, 'Wali_id');
    }

    // Relasi dengan Lulusan (One-to-Many)
    public function lulusans()
    {
        return $this->hasMany(Lulusan::class, 'Alumni_id');
    }
}