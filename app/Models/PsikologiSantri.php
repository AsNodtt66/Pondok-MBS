<?php

namespace App\Models;

use App\Models\Santri;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;

class PsikologiSantri extends Model
{
    protected $fillable = ['Santri_id', 'Tanggal_konseling', 'Hasil_psikologi', 'Catatan'];
     protected $dates = ['Tanggal_konseling'];

     protected $casts = [
        'Tanggal_konseling' => 'datetime'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'Santri_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'Pengguna_id');
    }
}