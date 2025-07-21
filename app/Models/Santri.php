<?php

namespace App\Models;

use App\Models\Wali;
use App\Models\Pembayaran;
use App\Models\ProgressHafalan;
use App\Models\PsikologiSantri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Santri extends Model
{
    protected $fillable = [
        'Nama_santri', 'Santri_id', 'Tanggal_lhr', 'Jenis_kelamin', 'Status_aksk',
        'Email', 'No_hp', 'Wali_id', 'Kelas', 'tempat_lahir', 'alamat', 'foto_profil'
    ];
    
    protected $casts = [
        'Tanggal_lhr' => 'date',
    ];

    public function psikologiSantris()
    {
        return $this->hasMany(PsikologiSantri::class, 'Santri_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'Santri_id');
    }

    public function progressHafalans()
    {
        return $this->hasMany(ProgressHafalan::class, 'Santri_id');
    }

    public function walis()
    {
        return $this->belongsTo(Wali::class, 'Wali_id')->withDefault();
    }

    public function getFotoProfilUrlAttribute()
    {
        return $this->foto_profil ? Storage::url($this->foto_profil) : null;
    }
}