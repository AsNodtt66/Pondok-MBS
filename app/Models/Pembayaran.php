<?php

namespace App\Models;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['Santri_id', 'Jenis_pembayaran', 'Jumlah', 'Tanggal_bayar', 'Metode_bayar', 'Status_bayar', 'Jatuh_tempo'];
    protected $dates = ['Tanggal_bayar', 'Jatuh_tempo'];
    protected $casts = [
    'Tanggal_bayar' => 'datetime',
    'Jatuh_tempo' => 'datetime'
];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'Santri_id');
    }
}