<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Pengguna;
use App\Models\Pembayaran;
use App\Models\ProgressHafalan;
use App\Models\PsikologiSantri;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'Jenis_laporan',
        'Tanggal_generate',
        'Tanggal_lapor',
        'Santri_id',
        'Psikologi_santri_id',
        'Pembayaran_id',
        'Progress_hafalan_id',
    ];

    protected $dates = ['Tanggal_generate', 'Tanggal_lapor']; // Otomatis konversi ke Carbon instance

    // Atau gunakan accessor
    public function getTanggalGenerateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
    public function getTanggalLaporAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function pembuat()
    {
        return $this->belongsTo(Pengguna::class, 'santri_id');
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'Santri_id');
    }

    public function psikologiSantri()
    {
        return $this->belongsTo(PsikologiSantri::class, 'Psikologi_santri_id');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'Pembayaran_id');
    }

    public function progressHafalan()
    {
        return $this->belongsTo(ProgressHafalan::class, 'Progress_hafalan_id');
    }
}